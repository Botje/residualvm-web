<div class="box">
	<div class="intro">
		<div class="navigation">
			<h2>Navigation</h2>
			<ul>
			{foreach from=$demos item=group}
				<li><a href="demos/#{$group.href}">{$group.name}</a></li>
			{/foreach}
			</ul>
		</div>
		<div class="text">
			<p>
				This page lists links to demos of various games, please contact us if you have a copy of any demo not listed here.
			</p>
		</div>
		<div class="spacing">&nbsp;</div>
	</div>
	<div class="content">
		{foreach from=$demos item=group}
		<a name="{$group.href}"></a>
		<table class="chart color4">
			<caption>{$group.name}</caption>
			<thead>
				<tr valign="top" class="color4">
					<th>Demo Name / Download Link</th>
					<th>Game Target</th>
				</tr>
			</thead>
			<tbody>
			{foreach from=$group.demos item=demo}
				<tr valign="top" class="{cycle values="color2, color0"}">
					<td><a href="{$demo->getURL()}">{$demo->getName()}</a></td>
					<td>{$demo->getTarget()}</td>
				</tr>
			{/foreach}
			</tbody>
		</table>
		{/foreach}
	</div>
</div>
