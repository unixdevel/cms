<?php namespace UnixDevel\Crawler\ReportWidgets;

use Backend\Classes\ReportWidgetBase;
use Exception;
use Illuminate\Support\Facades\Queue;

/**
 * CrawlerStatus Report Widget
 */
class CrawlerStatus extends ReportWidgetBase
{
    /**
     * @var string The default alias to use for this widget
     */
    protected $defaultAlias = 'CrawlerStatusReportWidget';

    /**
     * Defines the widget's properties
     * @return array
     */
    public function defineProperties(): array
    {
        return [
            'title' => [
                'title'             => 'backend::lang.dashboard.widget_title_label',
                'default'           => 'Crawler Status Report Widget',
                'type'              => 'string',
                'validationPattern' => '^.+$',
                'validationMessage' => 'backend::lang.dashboard.widget_title_error',
            ],
        ];
    }

    /**
     * Adds widget specific asset files. Use $this->addJs() and $this->addCss()
     * to register new assets to include on the page.
     * @return void
     */
    protected function loadAssets(): void
    {
    }

    /**
     * Renders the widget's primary contents.
     * @return string HTML markup supplied by this widget.
     */
    public function render()
    {
        try {
            $this->prepareVars();
        } catch (Exception $ex) {
            $this->vars['error'] = $ex->getMessage();
        }
        $this->vars["crawlerStatus"] = Queue::size("crawlerStatus");

        return $this->makePartial('crawlerstatus');
    }

    /**
     * Prepares the report widget view data
     */
    public function prepareVars():void
    {
    }
}
