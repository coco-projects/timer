<?php

    namespace Coco\timer;

    class Timer
    {
        protected array $report = [];

        protected float $startTimestamp    = 0;
        protected float $lastMarkTimestamp = 0;

        const START_MARK = '____START____';

        public function mark(string|int $mark): static
        {
            if (!$this->startTimestamp) {
                throw new \LogicException('must execute the start method first');
            }

            $microtime               = $this->getTime();
            $this->lastMarkTimestamp = $microtime;

            $this->report[$mark] = [
                "timestamp"   => $microtime,
                "since_start" => $this->formatTime($this->getTime() - $this->startTimestamp),
                'memory'      => memory_get_usage(),
                'memory_peak' => memory_get_peak_usage(),
            ];

            return $this;
        }

        public function start(): static
        {
            $this->startTimestamp = $this->getTime();

            return $this->mark(static::START_MARK);
        }

        public function sinceStartTime($mark): float|int
        {
            $report = $this->getMarkReport($mark);

            return $report['since_start'];
        }

        public function markCompare($startMark, $endMark,): float|int
        {
            $reportStart = $this->getMarkReport($startMark);
            $reportEnd   = $this->getMarkReport($endMark);

            return $this->formatTime($reportEnd['timestamp'] - $reportStart['timestamp']);
        }

        public function totalTime(): float|int
        {
            return $this->formatTime($this->getTime() - $this->startTimestamp);
        }

        public function lastMarkToNowTime()
        {
            return $this->formatTime($this->getTime() - $this->lastMarkTimestamp);
        }

        protected function formatTime($time): float|int
        {
            return sprintf("%.9f", $time);
        }

        public function getMarkMemory($mark): string
        {
            $report = $this->getMarkReport($mark);

            return $this->formatMemroy($report['memory']);
        }

        public function getMarkMemoryPeak($mark): string
        {
            $report = $this->getMarkReport($mark);

            return $this->formatMemroy($report['memory_peak']);
        }

        public function getTotalMemory(): string
        {
            return $this->formatMemroy(memory_get_usage());
        }

        public function getTotalMemoryPeak(): string
        {
            return $this->formatMemroy(memory_get_peak_usage());
        }

        protected function formatMemroy($bytes): string
        {
            $units = [
                'B',
                'KB',
                'MB',
                'GB',
                'TB',
            ];

            $unit = 0;
            while ($bytes >= 1024 && $unit < count($units) - 1) {
                $bytes /= 1024;
                $unit++;
            }

            return sprintf("%.10f %s", $bytes, $units[$unit]);
        }

        public function getReport(): array
        {
            return $this->report;
        }

        public function getMarkReport($mark): array
        {
            if (!array_key_exists($mark, $this->report)) {
                throw new \LogicException('mask does not exists');
            }

            return $this->report[$mark];
        }

        protected function getTime(): float|int
        {
            return hrtime(true) / 1e9;
        }
    }
