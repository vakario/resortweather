{if $stat}
{assign var="last_snowday" value=" "|explode:$stat->weather->snow_report[0]->last_snow_date}
{assign var="day_zero" value="-"|explode:$stat->weather->forecast[0]->date}
{assign var="day_one" value="-"|explode:$stat->weather->forecast[1]->date}

<div id="back_resort">
    <div class="container" id="mod_resort_weather">
        <div id="weather_container1" class="col-xs-6 col-sm-4 col-md-2">
            <div id="snow_day" class="col-xs-12 col-sm-12 col-md-12">
                <div class="margin_cont">
                    <div id="snow_day_title" class="day_title">{l s='last day' mod='resortweather'}</div>
                    <div id="snow_day_subtitle" class="day_date">{l s='snow' mod='resortweather'}</div>
                    <div class="meteo_icon" data-icon="W"></div>
                    <div class="snow_day_date">
                        <span class="day_value">{$last_snowday[1]} </span>
                        <span class="day_date">{smarty_function_get_month_traduction month=$last_snowday[0]}</span>
                     </div>
                </div>
            </div>
        </div>
        <div id="weather_container2" class="col-xs-6 col-sm-4 col-md-2">
            <div id="snow_info" class="col-xs-12 col-sm-12 col-md-12">
                <div class="margin_cont">
                    <div id="snow_info_title"  class="day_title">{l s='depth' mod='resortweather'}</div>
                    <div id="snow_info_subtitle"  class="day_date">{l s='snow' mod='resortweather'}</div>
                    <div id="snow_info_upper" class="col-xs-8 col-sm-8 col-md-8">
                        <div class="day_before_icon">{l s='Upper' mod='resortweather'}</div>
                        <div class="snow_info_depth">
                            <span class="day_value">{$stat->weather->snow_report[0]->upper_snow_depth}</span>
                            <span class="day_unit">cm</span>
                        </div>
                    </div>
                    <div id="snow_icon_upper"class="meteo_icon col-xs-4 col-sm-4 col-md-4" data-icon="M"></div>
                    <div id="snow_icon_lower" class="meteo_icon col-xs-4 col-sm-4 col-md-4" data-icon="M"></div>
                    <div id="snow_info_lower" class="col-xs-8 col-sm-8 col-md-8">
                        <div class="snow_info_depth">
                            <span class="day_value">{$stat->weather->snow_report[0]->lower_snow_depth}</span>
                            <span class="day_unit">cm</span>
                        </div>
                        <div class="day_before_icon">{l s='Lower' mod='resortweather'}</div>
                    </div>
                </div>
            </div>
        </div>
        <div id="weather_container3" class="col-xs-12 col-sm-8 col-md-4">
            <div id="day0_weather" class="col-xs-12 col-sm-12 col-md-12">
                <div class="margin_cont">
                    <div id="day0" class="day_title">{l s='Today' mod='resortweather'}</div>
                    <div id="day0_date" class="day_date">{smarty_function_get_day_traduction date=$stat->weather->forecast[0]->date} {$day_zero[2]} {smarty_function_get_month_traduction month=$day_zero[1]}</div>
                    <div id="day0_wind" class="day_wind col-xs-4 col-sm-4 col-md-4">
                        <div id="day0_wind_dir" class="day_before_icon">{$stat->weather->forecast[0]->day[0]->wind[0]->dir}</div>
                        <div id="day0_wind_icon" class="meteo_icon" data-icon="F"></div>
                        <div id="day0_wind_speed" class="day_value">{$stat->weather->forecast[0]->day[0]->wind[0]->speed}</div>
                        <div id="day0_wind_unit" class="day_unit">{$stat->weather->forecast[0]->day[0]->wind[0]->wind_unit}</div>
                    </div>
                    <div id="day0_day" class="day_weather col-xs-4 col-sm-4 col-md-4">
                        <div id="day0_day_day" class="day_before_icon">{l s='day' mod='resortweather'}</div>
                        <div id="day0_day_icon" class="meteo_icon" data-icon="{smarty_function_get_img codew=$stat->weather->forecast[0]->day[0]->weather_code}"></div>
                        <div id="day0_day_temp" class="day_value">{$stat->weather->forecast[0]->day_max_temp}</div>
                        <div id="day0_day_unit" class="day_unit">°{$stat->weather->forecast[0]->temp_unit}</div>
                    </div>
                    <div id="day0_night" class="night_weather col-xs-4 col-sm-4 col-md-4">
                        <div id="day0_night_day" class="day_before_icon">{l s='night' mod='resortweather'}</div>
                        <div id="day0_night_icon" class="meteo_icon" data-icon="{smarty_function_get_img codew=$stat->weather->forecast[0]->night[0]->weather_code}"></div>
                        <div id="day0_night_temp" class="day_value">{$stat->weather->forecast[0]->night_min_temp}</div>
                        <div id="day0_night_unit" class="day_unit">°{$stat->weather->forecast[0]->temp_unit}</div>
                    </div>
                </div>
            </div>
        </div>
        <div id="weather_container4" class="col-xs-12 col-sm-8 col-md-4">
            <div id="day1_weather" class="col-xs-12 col-sm-12 col-md-12">
                <div class="margin_cont">
                    <div id="day1" class="day_title">{l s='Tomorrow' mod='resortweather'}</div>
                    <div id="day1_date" class="day_date">{smarty_function_get_day_traduction date=$stat->weather->forecast[1]->date} {$day_one[2]} {smarty_function_get_month_traduction month=$day_one[1]}</div>
                    <div id="day1_wind" class="day_wind col-xs-4 col-sm-4 col-md-4">
                        <div id="day1_wind_dir" class="day_before_icon">{$stat->weather->forecast[1]->day[0]->wind[0]->dir}</div>
                        <div id="day1_wind_icon" class="meteo_icon" data-icon="F"></div>
                        <div id="day1_wind_speed" class="day_value">{$stat->weather->forecast[1]->day[0]->wind[0]->speed}</div>
                        <div id="day1_wind_unit" class="day_unit">{$stat->weather->forecast[1]->day[0]->wind[0]->wind_unit}</div>
                    </div>
                    <div id="day1_day" class="day_weather col-xs-4 col-sm-4 col-md-4">
                        <div id="day1_day_day" class="day_before_icon">{l s='day' mod='resortweather'}</div>
                        <div id="day1_day_icon" class="meteo_icon" data-icon="{smarty_function_get_img codew=$stat->weather->forecast[1]->day[0]->weather_code}"></div>
                        <div id="day1_day_temp" class="day_value">{$stat->weather->forecast[1]->day_max_temp}</div>
                        <div id="day1_day_unit" class="day_unit">°{$stat->weather->forecast[1]->temp_unit}</div>
                    </div>
                    <div id="day1_night" class="night_weather col-xs-4 col-sm-4 col-md-4">
                        <div id="day1_night_day" class="day_before_icon">{l s='night' mod='resortweather'}</div>
                        <div id="day1_night_icon" class="meteo_icon" data-icon="{smarty_function_get_img codew=$stat->weather->forecast[1]->night[0]->weather_code}"></div>
                        <div id="day1_night_temp" class="day_value">{$stat->weather->forecast[1]->night_min_temp}</div>
                        <div id="day1_night_unit" class="day_unit">°{$stat->weather->forecast[1]->temp_unit}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
{/if}