<?xml version="1.0" encoding="us-ascii"?>
<!DOCTYPE nzb PUBLIC "-//newzBin//DTD NZB 0.9//EN" "http://www.newzbin.com/DTD/nzb/nzb-0.9.dtd">
<nzb xmlns="http://www.newzbin.com/DTD/2003/nzb">
{foreach from=$binaries item=binary}

	<file poster="{$binary.binary.fromname|escape:'html'}" date="{$binary.binary.unixdate}" subject="{$binary.binary.name|escape:'html'} (1/{$binary.binary.totalParts})">
	<groups>
	{foreach from=$binary.groups item=group}
	<group>{$group}</group>
	{/foreach}</groups>
	<segments>
	{foreach from=$binary.parts item=part}
	<segment bytes="{$part.size}" number="{$part.partnumber}">{$part.messageID|escape:'html'}</segment>
	{/foreach}</segments>
	</file>
{/foreach}
<!-- generated by newznab -->
</nzb>
