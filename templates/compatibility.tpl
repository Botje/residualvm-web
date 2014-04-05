<div class="box">
	<div class="intro">
		<p>
			This page lists the progress of ResidualVM as it relates to individual game compatibility.
			Please note this list applies to the English versions of games. We attempt to test many versions of games, however there are occasionally problems with other languages.
		</p>
		<p>
			Click on the game name to view the complete notes of a game.
		</p>
		{if $version == 'DEV'}
			<p>
				This is the compatibility of the current development version, <b>not of a stable release</b>
				(Please see one of the following for the Compatibility charts of the stable releases:
				{foreach from=$versions item=ver name=versions_loop}
					{if $smarty.foreach.versions_loop.last}
						{assign var='last' value=')'}
					{/if}
					<a href="compatibility/{$ver}/">{$ver}</a>{$last}
				{/foreach}
			</p>
			<p>
				As this is the status of the development version, occasional temporary bugs
				may be introduced with new changes, thus this list refects the 'best case' scenario.
				It is highly recommended to use the latest stable release, where possible.
			</p>
		{else}
			<p>
				Also, this is the compatibility of the {$version} stable release, <b>not of current repository/daily builds</b>.
				The status of these can be found on the <a href="compatibility/">Development Compatibility</a> chart.
			</p>
			<p>
			You can also see the Compatibility chart for these releases:
			{foreach from=$versions item=ver}
				<a href="compatibility/{$ver}/">{$ver}</a>
			{/foreach}
			</p>
		{/if}
		<p>
			<small>Last Updated: {$last_updated}</small>
		</p>
	</div>
	<div class="content">
		<table class="chart color4 colorKeyTable">
			<caption>Color Key</caption>
			<tbody>
				<tr class="color2">
					{if $old_layout == 'no'}
						{foreach from=$support_level_desc key=level item=desc}
							<td class={$support_level_class.$level} align='center'>{$desc}</td>
						{/foreach}
					{else}
						<td class="pct0">&nbsp;0</td>
						<td class="pct5">&nbsp;5</td>
						<td class="pct10">10</td>
						<td class="pct15">15</td>
						<td class="pct20">20</td>
						<td class="pct25">25</td>
						<td class="pct30">30</td>
						<td class="pct35">35</td>
						<td class="pct40">40</td>
						<td class="pct45">45</td>
						<td class="pct50">50</td>
						<td class="pct55">55</td>
						<td class="pct60">60</td>
						<td class="pct65">65</td>
						<td class="pct70">70</td>
						<td class="pct75">75</td>
						<td class="pct80">80</td>
						<td class="pct85">85</td>
						<td class="pct90">90</td>
						<td class="pct95">95</td>
						<td class="pct100">100</td>
					{/if}
				</tr>
			</tbody>
		</table>

		{foreach from=$compat_data key=company item=games name=compat_loop}
			<table class="chart color4">
				<caption>{$company} Game Compatibility Chart</caption>
				<thead>
					<tr class="color4">
						<th class="gameFullName">Game Full Name</th>
						<th class="gameShortName">Game Short Name</th>
						{if $old_layout == 'no'}
							<th class="gameSupportLevel">Support Level</th>
						{else}
							<th class="gameSupportLevel">% Completed</th>
						{/if}
					</tr>
				</thead>
				<tbody>
				{foreach from=$games item=game}
					{if $old_layout == 'no'}
						{assign var="x" value=$game->getSupportLevel()}
						{assign var="pct_class" value=$support_level_class.$x}
						{assign var="support_level" value=$support_level_desc.$x}
					{else}
						{math equation="x - (x % 5)" x=$game->getSupportLevel() assign='pct_class'}
						{assign var="pct_class" value="pct"|cat:$pct_class}
						{assign var="support_level" value=$game->getSupportLevel()|cat:"%"}
					{/if}
					<tr class="color{cycle values='2,0'}">
						<td class="gameFullName"><a href="compatibility/{$version}/{$game->getTarget()}/">{$game->getName()}</a></td>
						<td class="gameShortName">{$game->getTarget()}</td>
						<td class="gameSupportLevel {$pct_class}">{$support_level}</td>
					</tr>
				{/foreach}
				</tbody>
			</table>
		{/foreach}
	</div>
</div>
