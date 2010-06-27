
			<h1>{$page->title}</h1>

			<p>
				Here lives the documentation for the api for accessing nzb and index data. Api functions can be
				called by either logged in users, or by providing an apikey.
			</p>
			
			{if $loggedin=="true"}
				<p>
					Your credentials should be provided as <span style="font-family:courier;">?apikey={$userdata.rsstoken}</span>
				</p>
			{/if}
			
			<h2>Available Functions</h2>
			<p>
				Use the parameter <span style="font-family:courier;">?t=</span> to specify the function being called.
				<ul>
					<li>
						<b>Capabilities</b> <span style="font-family:courier;"><a href="{$smarty.const.WWW_TOP}/api?t=caps">?t=caps</a></span>
						<br/>
						Reports the capabilities if the server. Includes information about the server name, available search categories and version number of the newznab protocol being used.
						<br/>
						Capabilities does not require any credentials in order to be ran.
					</li>	
					<li>
						<b>Search</b> <span style="font-family:courier;"><a href="{$smarty.const.WWW_TOP}/api?t=search&q=linux">?t=search&q=linux</a></span>
						<br/>
						Returns a list of nzbs matching a query. You can also  filter by site category by including a comma separated list of categories as follows <span style="font-family:courier;"><a href="{$smarty.const.WWW_TOP}/api?t=search&cat=1000,2000">?t=search&cat=1000,2000</a></span>. Include <span style="font-family:courier;">&extended=1</span> to return extended information in the search results.
					</li>
					<li>
						<b>TV</b> <span style="font-family:courier;"><a href="{$smarty.const.WWW_TOP}/api?t=tvsearch&q=law%20and%20order&season=7&ep=12">?t=tvsearch&q=law and order&season=7&ep=12</a></span>
						<br/>
						Returns a list of nzbs matching a query, category, tvrageid, season or episode. You can also filter by site category by including a comma separated list of categories as follows <span style="font-family:courier;"><a href="{$smarty.const.WWW_TOP}/api?t=tvsearch&rid=2204&cat=1000,2000">?t=tvsearch&rid=2204&cat=1000,2000</a></span>.  Include <span style="font-family:courier;">&extended=1</span> to return extended information in the search results.
					</li>
					<li>
						<b>Details</b> <span style="font-family:courier;"><a href="{$smarty.const.WWW_TOP}/api?t=details&id=9ca52909ba9b9e5e6758d815fef4ecda">?t=details&id=9ca52909ba9b9e5e6758d815fef4ecda</a></span>
						<br/>
						Returns detailed information about an nzb.
					</li>						
					<li>
						<b>Get</b> <span style="font-family:courier;"><a href="{$smarty.const.WWW_TOP}/api?t=get&id=9ca52909ba9b9e5e6758d815fef4ecda">?t=get&id=9ca52909ba9b9e5e6758d815fef4ecda</a></span>
						<br/>
						Downloads the nzb file associated with an Id.
					</li>	
				</ul>
			</p>

			<h2>Output Format</h2>
			<p>
				Obviously not appropriate to functions which return an nzb file.
			</p>
			<p>
				<ul>
					<li>
						Xml (default) <span style="font-family:courier;">?t=search&q=linux&o=xml</span>
						<br/>
						Returns the data in an xml document.
					</li>
					<li>
						Json <span style="font-family:courier;">?t=search&q=linux&o=json</span>
						<br/>
						Returns the data in a json object.
					</li>						
				</ul>
			</p>
			

			