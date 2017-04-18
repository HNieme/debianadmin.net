<?php 
include '../template/head.php';
include '../template/nav.php';?>

		<header>
			<div id="nav_menu_opener" <?php include 'template/diverses/headdesign.php';?>></div> <!-- in diese Datei müssen alle zusätzlichen Styleanweisungen kommen! -->
			<span>
				Editoren	& Co		<!-- Hier der Titel in der blauen?header-Leiste-->
			</span>
		</header>
		<main>
			<article> <!-- Hier der Inhalt-->
				<h1>Editoren & Co</h1>
					<p>
						Um Textdateien im Terminal bearbeiten zu können werden verschiedene Texteditoren verwendet.
					</p>
				<h2 id="NANO">NANO</h2>
					<p>	
						Für Anfänger empfiehlt sich vor allem <a href="https://packages.debian.org/jessie/nano">nano</a>.
						Die Tastenkombinationen sind schnell zu erlernen und das Programm ist für so gut wie alle Aufgaben 
						ausreichend. In allen Anleitungen dieser Webseite wird ausschließlich auf nano zurückgegriffen.
						<br /><br />
						Um Dateien barbeiten zu können ruft man diese per <code>nano DATEINAME</code> auf. Neue Dateien können 
						so ebenfalls erstellt werden, es wird einfach der Name der neuen Datei angegeben. Gibt man mehrere Pfade 
						an, können die Dateien der Reihe nach bearbeitet werden. 
						<br /><br />
						Beispiel: <code>nano /var/log/syslog</code>
						<br /><br />
						Im Editor wird der Cursor mit dem Pfeiltasten bewegt, verfügbare Tastenkombinationen stehen am unteren Rand des Editors. 
						<br />
						Im folgenden werden einige wichtige Tastenkombinationen aufgelistet:
						<br /><br />
						<code><b>Strg + w</b></code>: Suchen nach Wort oder Buchstabenfolgen, weitere Suchmethoden, wie etwa die Suche nach Zeilennummer werden 
						am unteren Rand angezeigt. Eine Suche kann wiederholt werden (etwa um mehrere Vorkommen des Wortes zu finden), indem mit 
						<code>Strg + w</code> erneut die Suche aufgerufen und sofort (ohne Eingabe) <code>Enter</code> gedrückt wird. In der Suchleiste 
						können alte Eingaben auch mit der Pfeiltaste nach oben gesehen und verwendet werden.
						<br /><br />
						<code><b>Strg + G</b></code>: Ruft eine Hilfe mit allen Tastenkombinationen auf.
						<br /><br />
						<code><b>Strg + X</b></code>: Verlässt den Editor wieder.
						<br /><br />
						Häufig ist nano nicht vorinstalliert und muss daher selbst installiert werden.
						
					</p>
				<h2 id="VIM">VIM</h2>
					<p>
						Ein weiterer Texteditor ist VIM. Ein Text, der den VIM beschreibt findet sich hier:
						<br />
						<a href="http://www.terminally-incoherent.com/blog/2012/03/21/why-vim/" hreflang="en">Why Vim?</a>
						<br /> 
						Weitere Infos:
						<br />
						<a href="https://wiki.debian.org/vim">Debian Wiki über VIM</a>
						<br />
						<a href="https://packages.debian.org/jessie/vim">Debian Package</a>
						<br />
					</p>
				<h2 id="WEITERE_TEXTEDITOREN">Weitere Texteditoren</h2>
					<p>
						<a href="https://wiki.debian.org/de/TextEditor">Debian Wiki: Texteditoren</a>
					</p>
					<br /><br /><br />
			<h1>Ähnliche Software</h1>
					<p>
						Oft muss der Inhalt von Dateien nicht verändert werden, sondern nur ausgegeben werden. Dabei helfen folgende Befehle:
					</p>
				<h2 id="CAT">CAT</h2>
					<p>
						<code>cat</code> gibt den Inhalt von Dateien vollständig aus.
						<br />
						Beispiel: <code> cat /etc/apt/sources.list </code>
					</p>
				<h2 id="TAIL">TAIL</h2>
					<p>
						<code>tail</code> gibt ddie letzten zehn Zeilen der angegebenen Datei aus. Dies kann durch das Argument <code>--lines=100</code> verändert werden. 
						<br />
						Das Argument <code>-F</code> bewirkt, dass zur Datei hinzugefügte Zeilen sofort ausgegeben werden, wieder beendet kann das durch <code>Strg + C</code> werden.
						Werden mehrere Dateien angegeben, so werden zuerst die Zeilen der zuerst angegebenen Datei ausgegeben, dann die der nächsten usw. Bei <code>-F</code> werden 
						neu hinzukommende Zeilen dann gemischt ausgegeben.
						<br />
						Beispiel: <code>tail -F syslog kern.log --lines=20</code>
					</p>
				<h2 id="WEITERES">WEITERES</h2>
					<p>
						Weitere Möglichkeiten, wie die Ausgabe von Text beeinflusst werden kann: 
						<br />
						<a href=""></a>
					</p>
				
					
					
					
					
					
					
					
					
					
					
					
					<br /><br /><br /><br /><br /><br /><br /><br /><br /><br />
						
			</article>
<?php 
include '../template/footer.php';
?>