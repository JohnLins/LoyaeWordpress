<?php
/**
 * Plugin Name: Loyae
 * Plugin URI:        https://loyae.com/
 * Description:       Seamlessly using machine learning to optimize web pages for searchability (SEO), usability, and accessibility!
 * Version: 1.01
 * Author:            Loyae
 */

$GLOBALS['base64logo'] = "data:image/svg+xml;base64,CjwhRE9DVFlQRSBzdmcgUFVCTElDICItLy9XM0MvL0RURCBTVkcgMjAwMTA5MDQvL0VOIiAiaHR0cDovL3d3dy53My5vcmcvVFIvMjAwMS9SRUMtU1ZHLTIwMDEwOTA0L0RURC9zdmcxMC5kdGQiPgo8c3ZnIHZlcnNpb249IjEuMCIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB2aWV3Qm94PSIwIDAgMTAwMDAgMTAwMDAiIHByZXNlcnZlQXNwZWN0UmF0aW89InhNaWRZTWlkIG1lZXQiPgo8ZyBpZD0ibGF5ZXIxMDEiIGZpbGw9IiNmMDgwODAiIHN0cm9rZT0ibm9uZSI+CiA8cGF0aCBkPSJNNDcyMCA5NDkxIGMtOCAtNSAtNjkgLTExIC0xMzUgLTE1IC02NiAtMyAtMTQ3IC0xMSAtMTgwIC0xNiAtMzMgLTYgLTEwMyAtMTcgLTE1NSAtMjUgLTEwNiAtMTcgLTE5NSAtMzUgLTI4NSAtNjAgLTMzIC0xMCAtOTEgLTI0IC0xMzAgLTMyIC0zOCAtOCAtNzkgLTE4IC05MCAtMjMgLTExIC00IC0zOCAtMTMgLTYwIC0xOCAtMjIgLTYgLTY1IC0yMCAtOTUgLTMyIC0zMCAtMTIgLTcxIC0yNiAtOTAgLTMyIC0xOSAtNSAtMzkgLTE0IC00NSAtMTkgLTUgLTUgLTE1IC05IC0yMyAtOSAtOCAwIC0yOCAtNiAtNDUgLTE0IC0xOCAtNyAtNTkgLTIzIC05MiAtMzYgLTYzIC0yNCAtMTM5IC01NiAtMTY1IC03MSAtMzUgLTE5IC0xNzggLTg5IC0xODMgLTg5IC0xMCAwIC0xNzUgLTk0IC0yNDAgLTEzNiAtMzcgLTI1IC03OSAtNTAgLTk1IC01NyAtMTUgLTYgLTI5IC0xNCAtMzIgLTE3IC0xMyAtMTQgLTcwIC01MCAtNzkgLTUwIC01IDAgLTExIC0zIC0xMyAtNyAtNSAtMTMgLTc2IC02MyAtODcgLTYzIC02IDAgLTExIC00IC0xMSAtOSAwIC01IC0xNSAtMTkgLTMzIC0zMCAtMTggLTExIC00MiAtMjggLTU0IC0zOCAtMTIgLTEwIC0zMSAtMjUgLTQzIC0zMyAtNDkgLTMzIC0xMjcgLTk3IC0xNjggLTEzNyAtMjMgLTI0IC00NSAtNDMgLTQ4IC00MyAtMTYgMCAtNDE0IC0zOTkgLTQxNCAtNDE0IDAgLTUgLTIxIC0zMCAtNDggLTU3IC01NyAtNTkgLTkyIC0xMDMgLTkyIC0xMTggMCAtNiAtMyAtMTEgLTcgLTExIC01IDAgLTIxIC0yMCAtMzggLTQ1IC0xNiAtMjQgLTMzIC00NSAtMzcgLTQ1IC01IDAgLTggLTcgLTggLTE1IDAgLTggLTkgLTE5IC0yMCAtMjUgLTExIC02IC0yMCAtMTcgLTIwIC0yNSAwIC04IC02IC0xOCAtMTIgLTIyIC0xNyAtMTEgLTU4IC02OSAtNTggLTgzIDAgLTUgLTQgLTEwIC04IC0xMCAtNSAwIC0xOSAtMjAgLTMxIC00NSAtMTIgLTI1IC0yNiAtNDUgLTMwIC00NSAtNCAwIC0xMyAtMTYgLTIwIC0zNSAtNyAtMTkgLTE3IC0zNSAtMjIgLTM1IC01IDAgLTkgLTYgLTkgLTE0IDAgLTggLTYgLTIxIC0xMyAtMjggLTcgLTcgLTIwIC0yNiAtMjggLTQzIC0yMyAtNDYgLTQzIC03OCAtNTYgLTkzIC03IC03IC0xMyAtMjAgLTEzIC0yOCAwIC04IC00IC0xNCAtMTAgLTE0IC01IDAgLTEwIC03IC0xMCAtMTUgMCAtOCAtMTAgLTM0IC0yMSAtNTcgLTEyIC0yNCAtMzEgLTYzIC00MyAtODggLTExIC0yNCAtMjcgLTUxIC0zMyAtNTggLTcgLTcgLTEzIC0yMiAtMTMgLTMzIDAgLTEwIC00IC0xOSAtMTAgLTE5IC01IDAgLTEyIC0xMiAtMTYgLTI3IC0zIC0xNiAtMTQgLTQ2IC0yNCAtNjggLTQwIC04OSAtNTAgLTExMyAtNTAgLTEyMyAwIC01IC03IC0yMyAtMTUgLTM4IC04IC0xNiAtMTUgLTM2IC0xNSAtNDQgMCAtOCAtOSAtMzMgLTIwIC01NSAtMTEgLTIyIC0xOSAtNTAgLTIwIC02MiAwIC0xMiAtNCAtMjMgLTkgLTI1IC02IC0xIC0xMyAtMTkgLTE2IC0zOCAtMyAtMTkgLTEwIC0zNyAtMTQgLTQwIC00IC0zIC0xNSAtNDEgLTI0IC04NSAtMjYgLTEyOSAtNDEgLTE5MCAtNDggLTE5NSAtNCAtMyAtMTAgLTI2IC0xNCAtNTMgLTQgLTI2IC0xMSAtNDkgLTE1IC01MiAtNSAtMyAtMTEgLTM2IC0xNSAtNzMgLTMgLTM3IC05IC03NCAtMTIgLTgyIC00IC04IC04IC0yNCAtOSAtMzUgLTExIC03MiAtMzYgLTI4NSAtNDQgLTM2MCAtMTEgLTEyMCAtMTEgLTYzNCAwIC03NjAgOSAtMTAyIDM2IC0zMTkgNDUgLTM2NSAzIC0xNCAxMCAtNTYgMTUgLTk1IDYgLTM4IDE0IC03NyAxNyAtODUgNCAtOCAxMiAtMzcgMTkgLTY1IDEzIC01MiAzMyAtMTI5IDQwIC0xNTUgMiAtOCAxMiAtNDkgMjIgLTkwIDkgLTQxIDIwIC04MCAyNCAtODUgMyAtNiA5IC0yNyAxMyAtNDggNCAtMjAgMTEgLTM3IDE1IC0zNyA3IDAgMjEgLTQyIDIyIC02NyAwIC01IDcgLTE3IDE0IC0yOCA4IC0xMSAxNCAtMjggMTQgLTM4IDAgLTEwIDcgLTMyIDE2IC00OCA4IC0xNyAxNyAtNDAgMjAgLTUyIDIgLTEyIDEwIC0zNiAxOSAtNTQgMTUgLTM0IDMyIC03MiA2NyAtMTUzIDExIC0yNSAyMyAtNTIgMjggLTYwIDUgLTggMTkgLTM1IDMxIC02MCAxMiAtMjUgMjUgLTUyIDMwIC02MCA1IC04IDE0IC0yNiAyMCAtNDAgNiAtMTQgMTUgLTMyIDIwIC00MCA1IC04IDE0IC0yNiAyMCAtNDAgNiAtMTQgMTggLTMzIDI2IC00MiA5IC0xMCAxMiAtMTggNyAtMTggLTUgMCAtMiAtNiA2IC0xMyA4IC03IDIxIC0yMyAyOCAtMzcgNyAtMTQgMjEgLTM4IDMyIC01NSAxMSAtMTYgMjYgLTQ0IDM0IC02MCAxOCAtMzggMTA3IC0xNjkgMTE4IC0xNzMgNCAtMiA4IC0xMCA4IC0xOCAwIC04IDcgLTE3IDE1IC0yMCA4IC00IDE1IC0xMSAxNSAtMTYgMCAtNiAxOCAtMzIgNDAgLTU4IDIyIC0yNiA0MCAtNTIgNDAgLTU3IDAgLTUgMTMgLTIzIDMwIC00MSAxNiAtMTggMzAgLTM4IDMwIC00MyAwIC01IDcgLTEyIDE1IC0xNSA4IC00IDE1IC0xMSAxNSAtMTcgMCAtNiAxNSAtMjUgMzMgLTQyIDE4IC0xNiA0NCAtNDYgNTkgLTY1IDE0IC0xOSA1MiAtNjMgODQgLTk2IDMzIC0zNCA4MyAtODkgMTEzIC0xMjMgMzAgLTM0IDU4IC02MSA2MiAtNjEgNCAwIDQ5IC0zOSA5OSAtODggNTEgLTQ4IDEwMyAtOTQgMTE1IC0xMDIgMTMgLTkgMzUgLTI4IDQ5IC00MyAxNCAtMTUgMzAgLTI3IDM2IC0yNyA1IDAgMTAgLTQgMTAgLTEwIDAgLTUgMTUgLTE3IDMzIC0yNiAxNyAtOSAzNCAtMjAgMzcgLTI0IDkgLTEzIDEzNiAtMTA2IDE1MyAtMTEzIDkgLTMgMTcgLTExIDE3IC0xNyAwIC01IDcgLTEwIDE1IC0xMCA4IDAgMTUgLTUgMTUgLTEwIDAgLTYgMTIgLTE2IDI4IC0yMyAxNSAtNiAyOSAtMTQgMzIgLTE3IDUgLTUgOTEgLTYxIDEzNSAtODggMTEgLTcgMzEgLTE4IDQ1IC0yNCAxNCAtNyAyOSAtMTggMzMgLTI1IDQgLTcgMTQgLTEzIDIyIC0xMyA3IDAgMjAgLTYgMjcgLTEzIDE3IC0xNSA0OSAtMzQgMTEzIC02NSAyOCAtMTMgNTcgLTI4IDY1IC0zMyA4IC01IDIyIC0xMiAzMCAtMTUgMjAgLTcgMTYxIC03NSAxODAgLTg1IDggLTUgMjYgLTE0IDQwIC0xOSAxNCAtNiAzNyAtMTcgNTIgLTI1IDE0IC04IDM0IC0xNSA0NSAtMTUgMTAgMCAyNyAtNyAzNyAtMTUgMTEgLTggMjcgLTE1IDM1IC0xNSA5IC0xIDM0IC05IDU2IC0yMCAyMiAtMTEgNDggLTE5IDU3IC0yMCA5IDAgMTkgLTQgMjIgLTkgNCAtNSAyNSAtMTIgNDkgLTE2IDIzIC00IDQ0IC0xMSA0NyAtMTYgMyAtNCAyOCAtMTMgNTUgLTIwIDI4IC02IDU3IC0xNSA2NiAtMTkgOSAtNSAzNCAtMTIgNTUgLTE1IDIyIC00IDQ4IC0xMCA1OSAtMTUgMjYgLTExIDE0NSAtNDAgMjIwIC01NCAzMyAtNiA2NSAtMTQgNzAgLTE3IDYgLTQgNDIgLTEwIDgwIC0xNCAzOSAtNCA3NyAtMTEgODYgLTE1IDggLTUgNjIgLTEyIDEyMCAtMTYgNTcgLTQgMTEwIC0xMSAxMTcgLTE3IDE4IC0xNSA2ODkgLTIxIDgyNyAtOCAyMzggMjMgMzIxIDMyIDMzNSAzOCA4IDQgNDkgMTIgOTAgMTkgMTAyIDE3IDIzMiA0NCAyNTAgNTEgOCA0IDM4IDEyIDY1IDE5IDI4IDcgNzAgMTcgOTUgMjMgMjUgNyA1MiAxNCA2MCAxOCA4IDQgMzggMTIgNjUgMTkgNTcgMTQgMTMyIDM5IDE1NyA1NCAxMCA2IDIzIDEwIDMwIDEwIDcgMCAyNCA2IDM4IDEzIDE0IDcgNDYgMTkgNzMgMjYgMjYgOCA1MCAxOCA1MyAyMiAzIDUgMTIgOSAyMCA5IDkgMCA2MSAyMiAxMTcgNDkgNTYgMjcgMTEyIDUyIDEyNSA1NiAxMiAzIDIyIDExIDIyIDE2IDAgNSA2IDkgMTQgOSAxNiAwIDExOCA0OSAxMjYgNjEgMyA0IDE4IDExIDMzIDE0IDE1IDQgMjcgMTEgMjcgMTYgMCA1IDYgOSAxMyA5IDggMCAyNCA5IDM3IDIwIDEzIDExIDI5IDIwIDM3IDIwIDcgMCAxMyA0IDEzIDkgMCA1IDE2IDE1IDM1IDIxIDE5IDYgMzUgMTYgMzUgMjEgMCA1IDcgOSAxNSA5IDcgMCAxOCA2IDIyIDEyIDggMTMgNDAgMzQgOTMgNjAgMTQgNyAyNyAxNSAzMCAxOCAzIDMgMTYgMTEgMzAgMTggMTQgNyA0NSAzMSA3MCA1MiAyNSAyMiA0OCA0MCA1MiA0MCA0IDAgMTMgNiAyMCAxMyA3IDYgMzIgMjUgNTYgNDEgMjMgMTYgNDIgMzMgNDIgMzcgMCA1IDcgOSAxNSA5IDcgMCAxOCA2IDIyIDEzIDQgNyAxOSAyMCAzMyAyOCAxNCA5IDQ2IDM2IDcxIDYwIDI2IDI0IDc3IDcyIDExMyAxMDYgMzYgMzUgNzEgNjMgNzcgNjMgNSAwIDcgNSA0IDEwIC0zIDYgMCAxMCA3IDEwIDE0IDAgMTI4IDEwOSAxMjggMTIzIDAgNSAyNyAzNCA2MCA2NSAzMyAzMiA2MCA2MSA2MCA2NSAwIDUgMjggMzcgNjIgNzMgMzQgMzUgNjYgNzIgNzIgODEgNSAxMCAxNSAyMiAyMyAyNiA3IDQgMTMgMTMgMTMgMTkgMCA3IDE3IDMyIDM4IDU3IDIxIDI1IDU0IDY4IDczIDk2IDQxIDU5IDQ5IDcxIDY5IDk0IDE0IDE3IDI0IDMzIDUzIDg0IDYgMTIgMTggMjYgMjUgMzAgNiA0IDEyIDE3IDEyIDI3IDAgMTAgNiAyMyAxMyAyNyA3IDQgMjEgMjYgMzIgNDggMTEgMjIgMzQgNjAgNTAgODUgMzQgNTAgMTQ1IDI3MiAxNDUgMjg5IDAgNiA1IDExIDEwIDExIDYgMCAxMCA0IDEwIDEwIDAgNSAyMyA1NyA1MCAxMTQgMjggNTcgNTAgMTA5IDUwIDExNiAwIDYgOSAyOSAyMCA1MCAxMSAyMiAxOCA0MCAxNiA0MCAtNiAwIDQwIDEyOCA1MSAxNDIgNiA3IDE0IDMxIDE4IDUzIDQgMjIgMTEgNDIgMTUgNDUgNSAzIDExIDE5IDE0IDM1IDE0IDczIDE3IDg2IDI2IDExMCA1IDE0IDEyIDQwIDE1IDU4IDQgMTggMTMgNTEgMjEgNzUgNyAyMyAxNCA1MSAxNCA2MSAwIDEwIDMgMjEgNyAyNSA3IDcgOCA4IDE4IDcxIDQgMjIgMTEgNjAgMTcgODUgNSAyNSAxNCA3OSAxOSAxMjAgNSA0MSAxMiA4NiAxNSAxMDAgMjQgMTAwIDM3IDMxMSAzNyA2MDUgMCAyNjIgLTE1IDU0MSAtMzAgNTc1IC05IDIyIC05IDE3IC0xNyAxMTAgLTUgNDcgLTEyIDkwIC0xNiA5NSAtNCA2IC0xMiA1MCAtMTggOTkgLTcgNDkgLTE2IDk0IC0yMSAxMDAgLTQgNiAtMTIgMzIgLTE1IDU4IC00IDI2IC0xMSA1MCAtMTYgNTMgLTQgMyAtMTEgMjkgLTE1IDU4IC00IDI4IC0xMSA1NyAtMTUgNjIgLTQgNiAtMTIgMzkgLTE5IDc0IC02IDM2IC0xNSA2OSAtMjEgNzUgLTUgNSAtMTAgMTcgLTEwIDI1IC0xIDkgLTkgMzQgLTIwIDU2IC0xMSAyMiAtMTkgNDggLTIwIDU3IDAgOSAtNCAxOSAtOSAyMiAtNSAzIC0xNCAyOCAtMjEgNTYgLTcgMjggLTE2IDUzIC0yMSA1NiAtNSAzIC05IDEzIC05IDIyIC0xIDkgLTkgMzUgLTIwIDU3IC0xMSAyMiAtMTkgNDMgLTIwIDQ3IDAgNCAtMTYgNDEgLTM1IDgyIC0xOSA0MSAtMzUgNzkgLTM1IDg1IDAgNSAtMyAxMSAtNyAxMyAtMTEgNCAtNzkgMTM4IC04NyAxNzEgLTMgMTUgLTExIDI3IC0xNiAyNyAtNiAwIC0xMCA2IC0xMCAxMyAwIDYgLTE4IDQwIC00MCA3NSAtMjIgMzQgLTQwIDY3IC00MCA3MiAwIDQgLTQgMTAgLTggMTIgLTUgMiAtMzIgNDQgLTYyIDkzIC02MCAxMDAgLTk4IDE1NCAtMjM3IDM0MCAtNSA2IC0yNSAzMSAtNDUgNTcgLTIxIDI1IC0zOCA1MCAtMzggNTQgMCA0IC0xNSAyMSAtMzIgMzkgLTE4IDE4IC04NCA4OSAtMTQ3IDE1OCAtNjMgNjkgLTE3MCAxNzcgLTIzOSAyMzkgLTY4IDYyIC0xNDEgMTI5IC0xNjIgMTQ4IC0yMCAxOSAtNDcgNDIgLTU5IDUwIC0yMSAxMyAtNTcgNDAgLTg2IDYzIC0xMTggOTIgLTI0NyAxODQgLTMxMCAyMjEgLTEyMCA3MSAtMTIwIDcxIC0xMjUgNzYgLTIzIDI1IC0yMTkgMTI4IC00NDUgMjM0IC02NiAzMSAtMTI3IDYxIC0xMzUgNjUgLTkgNSAtMzEgMTIgLTUwIDE2IC0xOSA0IC0zNyAxMCAtNDAgMTQgLTMgMyAtNDMgMTkgLTkwIDM1IC00NyAxNSAtOTkgMzQgLTExNyA0MiAtMTcgOCAtMzggMTQgLTQ2IDE0IC05IDAgLTE4IDQgLTIxIDkgLTQgNSAtMjUgMTIgLTQ4IDE2IC0yMyA0IC00OSAxMSAtNTggMTYgLTggNSAtNDYgMTUgLTg1IDIzIC0xNDEgMzAgLTE3MCAzNyAtMTg2IDQ2IC05IDQgLTM4IDExIC02NSAxNSAtMjcgNCAtNTYgOSAtNjQgMTMgLTI5IDExIC0yNTYgNDIgLTM5MCA1MiAtNzQgNiAtMTU1IDE1IC0xODAgMjEgLTUzIDExIC01MzggMTEgLTU2MCAweiBtLTg1IC0xMTQwIGM5OCAtMTAgMjYzIC0zOCAyOTAgLTUxIDExIC01IDM2IC0xMiA1NSAtMTUgMzggLTcgMTA3IC0yOSAxNTcgLTUxIDE3IC04IDQwIC0xNCA1MCAtMTQgMTEgMCAyOCAtNyAzOSAtMTUgMTAgLTggMjYgLTE1IDM1IC0xNSA5IDAgMjIgLTYgMjggLTE0IDcgLTggMjcgLTE3IDQ2IC0yMCAxOSAtNCAzNSAtMTEgMzUgLTE2IDAgLTUgMTIgLTEzIDI3IC0xNiAxNSAtNCA1OSAtMjkgOTcgLTU2IDM5IC0yNiA3NCAtNDggNzkgLTQ4IDUgMCA0NyAtMjkgOTMgLTY1IDQ2IC0zNiA4NiAtNjUgODkgLTY1IDMgMCAzMiAtMjYgNjYgLTU3IDMzIC0zMiA3MSAtNjMgODIgLTcwIDEyIC02IDI5IC0yMiAzNyAtMzQgMTcgLTI1IDgxIC05OSAxMjMgLTE0MSAxNSAtMTUgMjcgLTMyIDI3IC0zNyAwIC02IDcgLTE0IDE2IC0xOSA4IC01IDIxIC0xOCAyNyAtMjkgMjcgLTQ3IDkzIC0xNDcgMTEwIC0xNjQgOSAtMTEgMTcgLTIzIDE3IC0yOSAwIC01IDUgLTEwIDEwIC0xMCA2IDAgMTAgLTUgMTAgLTExIDAgLTYgOSAtMjMgMTkgLTM4IDExIC0xNSAyMyAtMzkgMjYgLTU0IDQgLTE1IDExIC0yNyAxNSAtMjcgNSAwIDEyIC0xNCAxNSAtMzIgNCAtMTcgMTQgLTM4IDIxIC00NiA4IC03IDE0IC0yMSAxNCAtMzAgMCAtOSA3IC0yNiAxNSAtMzYgOCAtMTEgMTUgLTI5IDE1IC00MSAwIC0xMiAzIC0yNSA4IC0yOSA0IC00IDcgLTExIDggLTE0IDAgLTQgMyAtMTQgNiAtMjIgMjEgLTU3IDM3IC0xMTAgNDMgLTE0MCAzIC0xOSAxMCAtNDQgMTUgLTU1IDEwIC0yMyAzMCAtMTEyIDM2IC0xNjUgMiAtMTkgOSAtNzggMTUgLTEzMCAxMyAtMTA5IDUgLTUwMCAtMTIgLTU3MCAtNSAtMjUgLTE1IC03MiAtMjEgLTEwNSAtNSAtMzMgLTE0IC02NCAtMTggLTcwIC00IC01IC0xMSAtMzIgLTE1IC01OSAtNCAtMjcgLTE0IC02MSAtMjEgLTc1IC04IC0xNCAtMTQgLTM0IC0xNCAtNDMgMCAtOSAtNCAtMTkgLTkgLTIzIC01IC0zIC0xNSAtMzAgLTIyIC02MCAtNyAtMzAgLTE2IC01NSAtMjAgLTU1IC00IDAgLTEwIC0xMyAtMTQgLTMwIC00IC0xNiAtMTEgLTMwIC0xNiAtMzAgLTUgMCAtMTIgLTEyIC0xNSAtMjcgLTQgLTE1IC0xMyAtMzggLTIwIC01MiAtOCAtMTQgLTE0IC0zMiAtMTQgLTM5IDAgLTcgLTcgLTE1IC0xNSAtMTggLTggLTQgLTEzIC05IC0xMSAtMTMgMyAtNCAtNiAtMjAgLTIwIC0zNiAtMTMgLTE1IC0yNCAtMzQgLTI0IC00MiAwIC03IC00IC0xMyAtMTAgLTEzIC01IDAgLTEwIC02IC0xMCAtMTMgMCAtOCAtOSAtMjUgLTIwIC0zOCAtMzEgLTM4IC0zNCAtNDIgLTQ5IC03MSAtOCAtMTYgLTE4IC0yOCAtMjMgLTI4IC01IDAgLTEzIC0xMSAtMTggLTI1IC01IC0xNCAtMTQgLTI1IC0yMCAtMjUgLTUgMCAtMTAgLTUgLTEwIC0xMSAwIC0xNyAtMTgwIC0yMDQgLTI3OSAtMjg5IC0zNSAtMzAgLTY5IC02MCAtNzUgLTY2IC03IC02IC0yNiAtMTkgLTQ0IC0yOCAtMTggLTkgLTMyIC0yMSAtMzIgLTI2IDAgLTYgLTcgLTEwIC0xNSAtMTAgLTcgMCAtMTggLTYgLTIyIC0xMyAtOCAtMTQgLTEyNSAtODcgLTEzOSAtODcgLTQgMCAtMTUgLTYgLTIzIC0xNCAtMjEgLTE5IC0xNTMgLTg2IC0xNjggLTg2IC03IDAgLTEzIC00IC0xMyAtOSAwIC01IC0xNSAtMTMgLTMyIC0xNiAtMTggLTQgLTM3IC0xMSAtNDMgLTE1IC01IC00IC0yNiAtMTMgLTQ1IC0xOCAtMTkgLTYgLTYyIC0yMSAtOTUgLTMzIC02MCAtMjEgLTE0MCAtNDEgLTI0NSAtNjAgLTMwIC02IC03MSAtMTUgLTkwIC0yMSAtNTIgLTE1IC00OTEgLTIyIC01NzUgLTkgLTM4IDcgLTEwMSAxNiAtMTQwIDIxIC0zOCA2IC03OSAxNCAtOTAgMjAgLTExIDUgLTQwIDEzIC02NSAxOSAtODEgMTcgLTE2NSA0MiAtMTc0IDUyIC02IDUgLTE2IDkgLTI0IDkgLTcgMCAtMzQgOSAtNjAgMjEgLTI2IDExIC02MyAyNyAtODIgMzYgLTczIDMxIC0xNzUgODUgLTIxNyAxMTQgLTI0IDE2IC00NyAyOSAtNTEgMjkgLTUgMCAtMTcgNyAtMjcgMTUgLTExIDggLTU0IDQwIC05NSA3MCAtMTE5IDg3IC0yMzcgMTk1IC0zNDYgMzE1IC01MSA1NyAtMTg3IDIzNyAtMjA1IDI3MiAtOCAxNSAtMzMgNTggLTU2IDk2IC0yMyAzNyAtNDUgODAgLTQ4IDk1IC00IDE1IC0xMSAyNyAtMTYgMjcgLTUgMCAtOSA1IC05IDExIDAgNiAtNiAyNSAtMTQgNDIgLTQ0IDk2IC01NiAxMjcgLTU2IDE0MSAwIDggLTQgMTcgLTkgMjEgLTUgMyAtMTUgMzEgLTIyIDYzIC03IDMxIC0xNSA2MiAtMTkgNjcgLTQgNiAtMTAgMzAgLTE0IDU1IC00IDI0IC0xMSA0OSAtMTYgNTUgLTUgNiAtMTMgNDUgLTE2IDg2IC00IDQxIC0xMiA4MCAtMTggODggLTE0IDE4IC0xOSA1MTAgLTUgNTY2IDExIDQ1IDEzIDU3IDIzIDEzNSA0IDMwIDE0IDc0IDIyIDk3IDcgMjQgMTUgNTcgMTYgNzQgMSAxNyA2IDMzIDEwIDM1IDQgMyA4IDE1IDggMjYgMCAxMiA4IDQwIDE4IDYyIDIxIDQ2IDM5IDk1IDUzIDE0NCA2IDE3IDE0IDMyIDE5IDMyIDYgMCAxMCA3IDEwIDE3IDAgMjIgNzIgMTY2IDg3IDE3NiA3IDQgMTMgMTIgMTMgMTcgMCAxNSA3MiAxMzQgODcgMTQzIDcgNCAxMyAxNSAxMyAyMiAwIDggNCAxNSA5IDE1IDUgMCAxOCAxNSAzMCAzMyAxMSAxNyAyNiA0MCAzMyA1MSAxOCAyNiAxMDEgMTE1IDE3OCAxOTAgMzYgMzUgODUgODQgMTEwIDEwOSAyNSAyNCA1MyA0NyA2MyA1MCA5IDQgMTcgMTEgMTcgMTcgMCA1IDUgMTAgMTEgMTAgNiAwIDI1IDExIDQzIDI1IDQ3IDM4IDQ4IDM5IDkxIDY1IDIyIDEzIDQyIDI3IDQ1IDMxIDMgNCAxNyAxMyAzMCAxOCAyOSAxMyA1OSAzMSA3OCA0OSA3IDYgMjIgMTIgMzEgMTIgMTAgMCAyNCA3IDMxIDE1IDcgOCAyMSAxNSAzMSAxNSA5IDAgMjQgNiAzMSAxMyAxNCAxNCAxNjEgNzMgMjIzIDg5IDIyIDYgNDUgMTQgNTAgMTggNiA0IDMwIDExIDU1IDE1IDI1IDQgNTAgMTEgNTUgMTUgMTEgOSAxODggNDAgMjg1IDUwIDkxIDEwIDM2OSAxMCA0NjUgMXoiLz4KIDwvZz4KCjwvc3ZnPg==";



global $wpdb;
$wpdb->show_errors();
 

$args = array(
    'numberposts'	=> 20,
    'category'		=> 0
);

$GLOBALS['posts'] = get_posts( $args );
$GLOBALS['pages'] = get_pages();


add_action('admin_menu', 'my_menu');
function my_menu() {
    add_menu_page('Loyae Admin', 'Loyae', 'manage_options', 'my-page-slug', 'loyae_admin_page', $GLOBALS['base64logo'], null);
}


class Diagnostic {
    public $is_meta_description;
    public $is_meta_og_description;
    public $is_meta_og_image;
    public $is_meta_og_image_alt;
    public $is_meta_og_image_width;
    public $is_meta_og_image_height;
    public $is_meta_og_image_type;
    public $is_meta_og_site_name;
    public $is_meta_og_keywords;
    public $is_meta_og_title;
    public $is_meta_og_url;
    public $is_meta_og_type;
    public $is_meta_keywords;
    public $is_meta_theme_color;
    public $is_meta_twitter_card;
    public $is_meta_twitter_title;
    public $is_meta_twitter_description;
    public $is_meta_twitter_image;
    public $is_meta_twitter_image_alt;
    public  $is_meta_twitter_url;
    public $is_meta_apple_mobile_web_app_status_bar_style;
    public $is_meta_apple_mobile_web_app_title;
    public $number_of_imgs;
    public $num_of_imgs_with_alt;
    public $cost_to_optimize;
}



$prices = null;
$pricesresp = wp_remote_get("https://api.loyae.com/prices");
if(!is_wp_error($pricesresp)){
    $prices= json_decode(wp_remote_retrieve_body($pricesresp));
}

$GLOBALS['ALTRATE'] = $prices->ALTRATE;
$GLOBALS['DESCRIPTIONRATE'] =  $prices->DESCRIPTIONRATE;
$GLOBALS['SIMPLEMETARATE'] = $prices->SIMPLEMETARATE;


function local_diagnostic($id){
    $output = new Diagnostic();

    

    $cost_to_optimize =3*$GLOBALS['DESCRIPTIONRATE'] + 2*$GLOBALS['ALTRATE'] + 17*$GLOBALS['SIMPLEMETARATE'];
    $response = wp_remote_get( get_permalink($id) );
    $body = wp_remote_retrieve_body( $response );
    $dom = new DOMDocument();

    
    libxml_use_internal_errors(true); 
    $dom->loadHTML($body);
    libxml_clear_errors();
    
    $images = $dom->getElementsByTagName("img");
    

    $output->number_of_imgs = count($images);

    $output->num_of_imgs_with_alt = 0;
    for ($i = 0; $i < $output->number_of_imgs; $i++){
        
      if($images->item($i)->attributes->getNamedItem("alt") && $images->item($i)->attributes->getNamedItem("alt")->value!=""){
        $output->num_of_imgs_with_alt++;
      }
    }

    $cost_to_optimize += $GLOBALS['ALTRATE'] * ($output->number_of_imgs - $output->num_of_imgs_with_alt);

    $metas = $dom->getElementsByTagName("meta");
    

    $output->is_meta_description = false;
    $output->is_meta_og_description = false;
    $output->is_meta_og_image = false;
    $output->is_meta_og_image_alt = false;
    $output->is_meta_og_image_width = false;
    $output->is_meta_og_image_height = false;
    $output->is_meta_og_image_type = false;
    $output->is_meta_og_site_name = false;
    $output->is_meta_og_keywords = false;
    $output->is_meta_og_title = false;
    $output->is_meta_og_url = false;
    $output->is_meta_og_type = false;
    $output->is_meta_keywords = false;
    $output->is_meta_theme_color = false;
    $output->is_meta_twitter_card = false;
    $output->is_meta_twitter_title = false;
    $output->is_meta_twitter_description = false;
    $output->is_meta_twitter_image = false;
    $output->is_meta_twitter_image_alt = false;
    $output->is_meta_twitter_url = false;
    $output->is_meta_apple_mobile_web_app_status_bar_style = false;
    $output->is_meta_apple_mobile_web_app_title = false;


    for ($i = 0; $i < count($metas); $i++){
        $temp;
        if($metas->item($i)->attributes->getNamedItem("name") != null){
            $temp = $metas->item($i)->attributes->getNamedItem("name")->value;
        } else if($metas->item($i)->attributes->getNamedItem("property") != null && $metas->item($i)->attributes->getNamedItem("property")!="<NULL>") {
            $temp = $metas->item($i)->attributes->getNamedItem("property")->value;
        } else {
            $temp = null;
        }
        

        if($temp == "description"){$output->is_meta_description = true;$cost_to_optimize-=$GLOBALS['DESCRIPTIONRATE'];}
        if($temp == "og:description"){$output->is_meta_og_description = true;$cost_to_optimize-=$GLOBALS['DESCRIPTIONRATE'];}
        if($temp == "og:image"){$output->is_meta_og_image = true;$cost_to_optimize-=$GLOBALS['SIMPLEMETARATE'];}
        if($temp == "og:image:alt"){$output->is_meta_og_image_alt = true;$cost_to_optimize-=$GLOBALS['ALTRATE'];}
        if($temp == "og:image:width"){$output->is_meta_og_image_width = true;$cost_to_optimize-=$GLOBALS['SIMPLEMETARATE'];}
        if($temp == "og:image:height"){$output->is_meta_og_image_height = true;$cost_to_optimize-=$GLOBALS['SIMPLEMETARATE'];}
        if($temp == "og:image:type"){$output->is_meta_og_image_type = true;$cost_to_optimize-=$GLOBALS['SIMPLEMETARATE'];}
        if($temp == "og:site_name"){$output->is_meta_og_site_name = true;$cost_to_optimize-=$GLOBALS['SIMPLEMETARATE'];}
        if($temp == "og:keywords"){$output->is_meta_og_keywords = true;$cost_to_optimize-=$GLOBALS['SIMPLEMETARATE'];}
        if($temp == "og:title"){$output->is_meta_og_title = true;$cost_to_optimize-=$GLOBALS['SIMPLEMETARATE'];}
        if($temp == "og:url"){$output->is_meta_og_url = true;$cost_to_optimize-=$GLOBALS['SIMPLEMETARATE'];}
        if($temp == "og:type"){$output->is_meta_og_type = true;$cost_to_optimize-=$GLOBALS['SIMPLEMETARATE'];}
        if($temp == "keywords"){$output->is_meta_keywords = true;$cost_to_optimize-=$GLOBALS['SIMPLEMETARATE'];}
        if($temp == "theme-color"){$output->is_meta_theme_color = true;$cost_to_optimize-=$GLOBALS['SIMPLEMETARATE'];}
        if($temp == "twitter:card"){$output->is_meta_twitter_card = true;$cost_to_optimize-=$GLOBALS['SIMPLEMETARATE'];}
        if($temp == "twitter:title"){$output->is_meta_twitter_title = true;$cost_to_optimize-=$GLOBALS['SIMPLEMETARATE'];}
        if($temp == "twitter:description"){$output->is_meta_twitter_description = true;$cost_to_optimize-=$GLOBALS['DESCRIPTIONRATE'];}
        if($temp == "twitter:image"){$output->is_meta_twitter_image = true;$cost_to_optimize-=$GLOBALS['SIMPLEMETARATE'];}
        if($temp == "twitter:image:alt"){$output->is_meta_twitter_image_alt = true;$cost_to_optimize-=$GLOBALS['ALTRATE'];}
        if($temp == "twitter:url"){$output->is_meta_twitter_url = true;$cost_to_optimize-=$GLOBALS['SIMPLEMETARATE'];}
        if($temp == "apple-mobile-web-app-status-bar-style"){$output->is_meta_apple_mobile_web_app_status_bar_style = true;$cost_to_optimize-=$GLOBALS['SIMPLEMETARATE'];}
        if($temp == "apple-mobile-web-app-title"){$output->is_meta_apple_mobile_web_app_title = true;$cost_to_optimize-=$GLOBALS['SIMPLEMETARATE'];}


    }

$output->cost_to_optimize = round($cost_to_optimize,2);

if(abs($output->cost_to_optimize) < .01){
    $output->cost_to_optimize = 0.00;
}

    return $output;
}


add_action( 'admin_post_loyae_form', 'loyae_form_handler' );
function loyae_admin_page() {

   

        echo    '<br/><div><center>
                <img src="'.$GLOBALS['base64logo'].'" height="20px;"/> 
                <h1 style="display:inline-block;">Loyae </h1> <h6 style="display:inline-block;">V1.01</h6><br/>
                <br/><hr/><br/>
                <h2 id="loader" style="display:none">Loading... Please be patient as we diagnose your entire website (this can take some time)</h2>
                <script>
                const loader = document.getElementById("loader"); loader.style.display = "block";
                var totalAmount = 0.0;
                </script>
                </center></div>';


        $post_table = '<form action="admin-post.php" method="post">
                       <input type="hidden" name="action" value="loyae_form">';

        foreach(array("posts", "pages") as $cat){
            if( ! empty( $GLOBALS[$cat] ) ){
                $post_table .= '<center> Everything: <input type="checkbox" cost="0" onclick="toggle(this, `'.$cat.'`)" onchange="sumAmount(this)"/><br/><br/><div class="table-container"><table class="timecard">
                                <caption>'.ucfirst($cat).'</caption>
                                <thread>
                                <tr>
                                <th></th>
                                <th>Post</th>
                               <!-- <th>Diagnostic (Free)</th>-->
                                <th>Image Alt Text</th>
                                <th>Meta Description</th>
                                <th>OG Meta Tags</th>
                                <th>Other Tags<br/></th>
                                </tr>
                                </thread>';

                              
                
                for($i = 0; $i < count($GLOBALS[$cat]); $i++){
                    $class = ''; if($i % 2 == 0){ $class = 'even';}else {$class = 'odd';}
                        $id = ($GLOBALS[$cat])[$i]->ID;
                        $temp_local_diagnostic = local_diagnostic($id);
                                
                                $post_table .= '<tr class="'. $class .'">


                                <td><input type="checkbox" name="'.$id.'_box" class="'.$cat.'" cost="'.$temp_local_diagnostic->cost_to_optimize.'" onchange="sumAmount(this)"/> ($'.$temp_local_diagnostic->cost_to_optimize.')</td>
                                <td><a href="' . get_permalink($id) .'">' 
                                . ($GLOBALS[$cat])[$i]->post_title .' ('.$id.') </a></td>
                                <!--<td><a href="javascript:diagnose('.$GLOBALS[$cat][$i]->ID.')">🔍</a></td>-->

                                <td><span>Missing <b>'. ($temp_local_diagnostic->number_of_imgs - $temp_local_diagnostic->num_of_imgs_with_alt) .'</b> of '.$temp_local_diagnostic->number_of_imgs.'</span></td>
                            

                                <td>'. ($temp_local_diagnostic->is_meta_description==true ? '<span style="color: green;">Has</span>'  : ' <span style="color: red;">Missing</span>') .'</td>
                            

                                <td>'.
                                ($temp_local_diagnostic->is_meta_og_description==true?"<b style='color:green'>Has</b>":"<b style='color:red'>Missing</b>"). " og:description<br/>".
                                ($temp_local_diagnostic->is_meta_og_image==true?"<b style='color:green'>Has</b>":"<b style='color:red'>Missing</b>"). " og:image<br/>".
                                ($temp_local_diagnostic->is_meta_og_image_alt==true?"<b style='color:green'>Has</b>":"<b style='color:red'>Missing</b>"). " og:image:alt<br/>".
                                ($temp_local_diagnostic->is_meta_og_image_width==true?"<b style='color:green'>Has</b>":"<b style='color:red'>Missing</b>"). " og:image:width<br/>".
                                ($temp_local_diagnostic->is_meta_og_image_height==true?"<b style='color:green'>Has</b>":"<b style='color:red'>Missing</b>"). " og:image:height<br/>".
                                ($temp_local_diagnostic->is_meta_og_image_type==true?"<b style='color:green'>Has</b>":"<b style='color:red'>Missing</b>"). " og:image:type<br/>".
                                ($temp_local_diagnostic->is_meta_og_site_name==true?"<b style='color:green'>Has</b>":"<b style='color:red'>Missing</b>"). " og:site_name<br/>".
                                ($temp_local_diagnostic->is_meta_og_keywords==true?"<b style='color:green'>Has</b>":"<b style='color:red'>Missing</b>"). " og:keywords<br/>".
                                ($temp_local_diagnostic->is_meta_og_title==true?"<b style='color:green'>Has</b>":"<b style='color:red'>Missing</b>"). " og:title<br/>".
                                ($temp_local_diagnostic->is_meta_og_url==true?"<b style='color:green'>Has</b>":"<b style='color:red'>Missing</b>"). " og:url<br/>".
                                ($temp_local_diagnostic->is_meta_og_type==true?"<b style='color:green'>Has</b>":"<b style='color:red'>Missing</b>"). " og:type<br/>"
                                .'</td>
                            



                                <td>'.
                                ($temp_local_diagnostic->is_meta_keywords==true?"<b style='color:green'>Has</b>":"<b style='color:red'>Missing</b>"). " keywords<br/>".
                                ($temp_local_diagnostic->is_meta_theme_color==true?"<b style='color:green'>Has</b>":"<b style='color:red'>Missing</b>"). " theme-color<br/>".
                                ($temp_local_diagnostic->is_meta_twitter_card==true?"<b style='color:green'>Has</b>":"<b style='color:red'>Missing</b>"). " twitter:card<br/>".
                                ($temp_local_diagnostic->is_meta_twitter_title==true?"<b style='color:green'>Has</b>":"<b style='color:red'>Missing</b>"). " twitter:title<br/>".
                                ($temp_local_diagnostic->is_meta_twitter_description==true?"<b style='color:green'>Has</b>":"<b style='color:red'>Missing</b>"). " twitter:description<br/>".
                                ($temp_local_diagnostic->is_meta_twitter_image==true?"<b style='color:green'>Has</b>":"<b style='color:red'>Missing</b>"). " twitter:image<br/>".
                                ($temp_local_diagnostic->is_meta_twitter_image_alt==true?"<b style='color:green'>Has</b>":"<b style='color:red'>Missing</b>"). " twitter:image:alt<br/>".
                                ($temp_local_diagnostic->is_meta_twitter_url==true?"<b style='color:green'>Has</b>":"<b style='color:red'>Missing</b>"). " twitter:url<br/>".
                                ($temp_local_diagnostic->is_meta_apple_mobile_web_app_status_bar_style==true?"<b style='color:green'>Has</b>":"<b style='color:red'>Missing</b>"). " apple-mobile-web-app-status-bar-style<br/>".
                                ($temp_local_diagnostic->is_meta_apple_mobile_web_app_title==true?"<b style='color:green'>Has</b>":"<b style='color:red'>Missing</b>"). " apple-mobile-web-app-title<br/>"
                                .'</td>
                               

                                </tr>';
                }
                $post_table .= '</table></div></center> </br></br></br>';
                
        
            } else {
                $post_table .= '<table class="timecard">
                                <caption>'.ucfirst($cat).'</caption>
                                <thread>NONE</thread>
                                </table>';
            }



        }


        
        

        $post_table .= '<script>

                        function toggle(source, name) {
                            checkboxes = document.getElementsByClassName(name);
                            for(var i=0, n=checkboxes.length;i<n;i++) {
                              checkboxes[i].checked = source.checked;
                            }
                            
                          }

                          function sumAmount(source) {
                            var temp = 0.0;
                            checkboxes = document.getElementsByClassName("pages")
                            for(var i=0, n=checkboxes.length;i<n;i++) {
                                if(checkboxes[i].checked){
                                    temp += parseFloat(checkboxes[i].getAttribute("cost"));
                                }
                            }
                            checkboxes = document.getElementsByClassName("posts")
                            for(var i=0, n=checkboxes.length;i<n;i++) {
                                if(checkboxes[i].checked){
                                    temp += parseFloat(checkboxes[i].getAttribute("cost"));
                                }
                            }

                            totalAmount = temp.toFixed(2);

                            document.getElementById("optimize").setAttribute("value", "Optimize ($"+totalAmount+")");
                            document.getElementById("amount").value = totalAmount;
                          }

                          function optmiz(){
                            const o = document.getElementById("optimize");
                            o.disable = true;
                            o.style.backgroundColor="gray";
                            o.value = "loading... (this will take a while)";
                          }
                          

              
                        </script>';


        echo $post_table;

        echo   '<br/><!--<center>
                <b>Override All Current:</b> Alt data: <input type="checkbox"/>, 
                Meta Descriptions: <input type="checkbox"/>, 
                Meta Keywords: <input type="checkbox"/>,
                Open Graph Meta Tags: <input type="checkbox"/>,
                Essential Tags: <input type="checkbox"/>,
                Non-Essential Tags: <input type="checkbox"/>

                <br/></center>-->





                <!--payment-->
                <div id="outcard">
                <div id="card-contain">
                <div style="text-align: left;">
                <div class="input-label">First Name</div>
                <input type="text" name="fname"/>
                <br/><br/>

                <div class="input-label">Last Name</div>
                <input type="text" name="lname"/>
                <br/><br/>

                <div class="input-label">Email</div>
                <input type="text" name="email"/>
                <br/><br/>

                <div class="input-label">Card Number </div>
                <input type="text" name="number" maxlength="16" placeholder="• • • •   • • • •   • • • •   • • • •" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"/>
                <br/><br/>

                <div class="input-label">CVC</div>
                <input type="text" name="cvc" maxlength="3" style="width: 60px;" placeholder="• • •" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"/>
                <br/><br/>

                <div class="input-label">Expiration Year</div>
                <input type="text" name="expy" maxlength="4" style="width: 80px;" placeholder="20 • •" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"/>
                <br/><br/>

                <div class="input-label">Expiration month</div>
                <input type="text" name="expm" maxlength="2" min="1" max="12" style="width: 50px;" placeholder="• •" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"/>
                <br/><br/>

                <div class="input-label">Billing Address</div>
                <input type="text" name="address"/>
                <br/><br/>

                <div class="input-label">City</div>
                <input type="text" name="city"/>
                <br/><br/>

                <div class="input-label">State</div>
                <input type="text" name="state"/>
                <br/><br/>

                <div class="input-label">Zip or Postal Code</div>
                <input type="text" name="zip"/>
                <br/><br/>
                <div class="input-label">Country</div>
                <input type="text" name="country"/>


                <input type="number" name="amount" id="amount" step="0.01" min="0" style="display:none"/>
                <br/><br/>
                <div id="auth-logo">
                <a href="https://www.authorize.net/">
                <img src="https://www.authorize.net/content/dam/anet-redesign/reseller/authorizenet-200x50.png" border="0" alt="Authorize.net Logo" width="100" height="25"/>
                </a>
                </div>
                </div>
                </div>
                </div>


                <style>
                .table-container{
                    overflow-y:scroll;
                    max-height: 300px;
                    
                
                    width: 90%;
                    position: relative; 
                    
                }
                
                caption {
                    border-top-right-radius: 10px;
                    border-top-left-radius: 10px;
                }
                    
                table.timecard {
                    margin: auto;
                    width: 100%;
                    border-collapse: collapse;
                    box-shadow: 0 0 25px gray;
                }
                
                table.timecard caption {
                    background-color: lightcoral;
                    color: #fff;
                    letter-spacing: .3em;
                    padding: 4px;
                }
                
                table.timecard thead th {
                    padding: 8px;
                    background-color: white;
                    font-size: large;
                }
                
                table.timecard thead th #thDay {
                    width: 40%;	
                }
                
                table.timecard thead th #thRegular, table.timecard thead th#thOvertime, table.timecard thead th#thTotal {
                    width: 20%;
                }
                
                table.timecard th, table.timecard td {
                    padding: 3px;
                    border-width: 1px;
                    border-style: solid;
                    border-color: #fdf1f1 lightgray;
                }
                
                table.timecard td {
                    text-align: left;
                }
                
                table.timecard tbody th {
                    text-align: left;
                    font-weight: normal;
                }
                
                table.timecard tr.even {
                    background-color: #fdf1f1;
                }
                table.timecard tr.odd {
                    background-color: white;
                }
                
                input[type="submit"]{
                    padding: 7px;
                    margin: 7px;
                    background-color: lightcoral;
                    border-radius: 5px;
                    border: 0;
                    color: white;
                    box-shadow: 0px 0px 15px lightgray;
                }
                
                input[type="submit"]:hover {
                    filter: brightness(95%);
                    cursor: pointer;
                }
                    /*payment style*/
                    input[type=text], input[type=number] {
                        border-radius: 5px;
                        border: 1px lightcoral solid;
                        background-color:  #fdf1f1;
                        height: 30px;
                        padding: 5px;
                        border: 2px;
                    }
                    
                    #auth-logo {
                        float: right;
                    }
                    
                    #card-contain {
                        height: auto;
                        width: auto;
                        position:relative;
                        display: inline-block;
                        border: 2px lightcoral solid;
                        padding: 10px;
                        border-radius: 7px; 
                    }
                    
                    #outcard {
                        display: flex;
                        justify-content: center;
                    }
                    
                    ::placeholder{
                        color: lightcoral;
                    }
                </style>



                <br/><center>
                <p>By continuing, you agree to the <a href="https://www.loyae.com/terms.pdf">terms</a></p>
                <br/>
                <input type="submit" name="optimize" value="Optimize ($0.00)" id="optimize" onclick="return optmiz()"/>
                </center>
                </form>';


        if(isset($_POST["check_alt"])) {
            echo  $_POST['check_alt'];
        }
    
        echo '<script>loader.style.display = "none";</script>';
       
}





 class GeneratedMeta {
    public $ID;
    public $loyae_description;
    public $loyae_og_description;
    public $loyae_og_image;
    public $loyae_og_image_alt;
    public $loyae_og_image_width;
    public $loyae_og_image_height;
    public $loyae_og_image_type;
    public $loyae_og_site_name;
    public $loyae_og_title;
    public $loyae_og_url;
    public $loyae_og_type;
    public $loyae_og_keywords;
    public $loyae_keywords;
    public $loyae_theme_color;
    public $loyae_twitter_card;
    public $loyae_twitter_title;
    public $loyae_twitter_description;
    public $loyae_twitter_image;
    public $loyae_twitter_image_alt;
    public $loyae_twitter_url;
    public $loyae_apple_mobile_web_app_status_bar_style;
    public $loyae_apple_mobile_web_app_title;
    public $loyae_optimized;
    public $loyae_alt;
 }



function loyae_null_case($str){
    if($str == null || $str == ""){
        return "<NULL>";
    }

    return $str;
} 

function get_generated_meta($id, $email, $cardnum){
    $rootapiurl = "https://api.loyae.com";//"http://localhost:8080";

    $meta = new GeneratedMeta();
    $post_class = get_post($id);



    $post_text = wp_strip_all_tags(apply_filters('the_content', get_post_field('post_content', $id)));
    
    $srcs = array();
    $imgs = array(''=>'');
    $dom = new DOMDocument();
    libxml_use_internal_errors(true); 
    $dom->loadHTML($post_class->post_content);
    libxml_clear_errors();
    $images = $dom->getElementsByTagName('img');


    
    for ($i = 0; $i < count($images); $i++) {
        $srcs[$i] = $images[$i]->getAttribute('src');
        $imgs[$srcs[$i]] = $images[$i]->getAttribute('alt');
    }


    $all_metas = array(''=>'');
    $metas = $dom->getElementsByTagName("meta");
    for ($i = 0; $i < count($metas); $i++){
        $temp;
        if($metas->item($i)->attributes->getNamedItem("name") != null){
            $temp = $metas->item($i)->attributes->getNamedItem("name")->value;
        } else if($metas->item($i)->attributes->getNamedItem("property") != null && $metas->item($i)->attributes->getNamedItem("property")!="<NULL>") {
            $temp = $metas->item($i)->attributes->getNamedItem("property")->value;
        } else {
            $temp = null;
        }


        if($temp != null){
            $all_metas[$temp] = $metas->item($i)->attributes->getNamedItem("value")->value ?? $metas->item($i)->attributes->getNamedItem("content")->value;
        }
        
    }



    $apiurl = $rootapiurl.'/optimize/manual';

    
    $data = array(
        'User' => array('Email' => $email, 'CardNum' => $cardnum),
        'Url' => get_permalink($id),
        'Content' => $post_text,
        'Metas' => $all_metas,
        'Imgs' => $imgs
    );

   
    
    $json_data = json_encode($data);
    
    
    $ch = curl_init($apiurl);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $json_data);
    $response = curl_exec($ch);
    if ($response === false) {
        echo 'cURL error: ' . curl_error($ch);
    }
    
    curl_close($ch);
   
    $response_data = $response ? json_decode($response, true) : null;
    //echo "Response: ";
    //var_dump($response_data);
    


if($response_data != null){

   $diagnostic = local_diagnostic($id);
    $meta->ID = $id;
    $meta->loyae_description = (!$diagnostic->is_meta_description) ? loyae_null_case($response_data['Metas']['description']): "<NULL>";
    $meta->loyae_og_description = (!$diagnostic->is_meta_og_description) ? loyae_null_case($response_data['Metas']['og:description']): "<NULL>";
    $meta->loyae_og_image = (!$diagnostic->is_meta_og_image) ? loyae_null_case($response_data['Metas']['og:image']): "<NULL>";
    $meta->loyae_og_image_alt = (!$diagnostic->is_meta_og_image_alt) ? loyae_null_case($response_data['Metas']['og:image:alt']): "<NULL>";
    $meta->loyae_og_image_width = (!$diagnostic->is_meta_og_image_width) ? loyae_null_case($response_data['Metas']['og:image:width']): "<NULL>";
    $meta->loyae_og_image_height = (!$diagnostic->is_meta_og_image_height) ? loyae_null_case($response_data['Metas']['og:image:height']): "<NULL>";
    $meta->loyae_og_image_type = (!$diagnostic->is_meta_og_image_type) ? loyae_null_case($response_data['Metas']['og:image:type']): "<NULL>";
    $meta->loyae_og_site_name = (!$diagnostic->is_meta_og_site_name) ? loyae_null_case($response_data['Metas']['og:site_name']): "<NULL>";
    $meta->loyae_og_title = (!$diagnostic->is_meta_og_title) ? loyae_null_case($response_data['Metas']['og:title']): "<NULL>";
    $meta->loyae_og_url = (!$diagnostic->is_meta_og_url) ? loyae_null_case($response_data['Metas']['og:url']): "<NULL>";
    $meta->loyae_og_type = (!$diagnostic->is_meta_og_type) ? loyae_null_case($response_data['Metas']['og:type']): "<NULL>";
    $meta->loyae_og_keywords = (!$diagnostic->is_meta_og_keywords) ? loyae_null_case($response_data['Metas']['og:keywords']): "<NULL>";
    $meta->loyae_keywords = (!$diagnostic->is_meta_keywords) ? loyae_null_case($response_data['Metas']['keywords']): "<NULL>";
    $meta->loyae_theme_color = (!$diagnostic->is_meta_theme_color) ? loyae_null_case($response_data['Metas']['theme-color']): "<NULL>";
    $meta->loyae_twitter_card = (!$diagnostic->is_meta_twitter_card) ? loyae_null_case($response_data['Metas']['twitter:card']): "<NULL>";
    $meta->loyae_twitter_title = (!$diagnostic->is_meta_twitter_title) ? loyae_null_case($response_data['Metas']['twitter:title']): "<NULL>";
    $meta->loyae_twitter_description = (!$diagnostic->is_meta_twitter_description) ? loyae_null_case($response_data['Metas']['twitter:description']): "<NULL>";
    $meta->loyae_twitter_image = (!$diagnostic->is_meta_twitter_image) ? loyae_null_case($response_data['Metas']['twitter:image']): "<NULL>";
    $meta->loyae_twitter_image_alt = (!$diagnostic->is_meta_twitter_image_alt) ? loyae_null_case($response_data['Metas']['twitter:image:alt']): "<NULL>";
    $meta->loyae_twitter_url = (!$diagnostic->is_meta_twitter_url) ? loyae_null_case($response_data['Metas']['twitter:url']): "<NULL>";
    $meta->loyae_apple_mobile_web_app_status_bar_style = (!$diagnostic->is_meta_apple_mobile_web_app_status_bar_style) ? loyae_null_case($response_data['Metas']['apple-mobile-web-app-status-bar-style']): "<NULL>";
    $meta->loyae_apple_mobile_web_app_title = (!$diagnostic->is_meta_apple_mobile_web_app_title) ? loyae_null_case($response_data['Metas']['apple-mobile-web-app-title']): "<NULL>";
    $meta->loyae_optimized = date('Y-m-d');
   

   
//echo "RESPONSE IMGS:". $response_data['Imgs'];

    //$temp_loyae_alt = array();

    $temp_loyae_alt = $response_data['Alts'];

//echo "TEMP_LOYAE_ALT:" .  $temp_loyae_alt;





    $meta->loyae_alt = serialize($temp_loyae_alt);

    //echo "SERTAL:" . $meta->loyae_alt;
        
}

    return (array)$meta; 
}




function loyae_form_handler() {

    if($_POST['email']!= "" && $_POST['fname'] != "" && $_POST['lname'] != "" && $_POST['number'] != "" && $_POST['cvc'] != "" && $_POST['expm'] != "" && $_POST['expy'] != "" && $_POST['amount'] >= 0.2 && $_POST['address'] != "" && $_POST['city'] != "" && $_POST['state'] != "" && $_POST['zip'] != "" && $_POST['country'] != ""){
            
    $fundurl = "https://api.loyae.com/optimize/fund?email=".$_POST['email']."&fname=".$_POST['fname']."&lname=".$_POST['lname']."&number=".$_POST['number']."&cvc=".$_POST['cvc']."&expm=".$_POST['expm']."&expy=".$_POST['expy']."&amount=".$_POST['amount']."&discount=NONE"."&address=".$_POST['address'] ."&city=". $_POST['city'] ."&state=". $_POST['state']."&zip=". $_POST['zip'] ."&country=". $_POST['country'];
      
       $funddata = null;
        $fund = wp_remote_get($fundurl);
        if(!is_wp_error($fund)){
            $funddata= json_decode(wp_remote_retrieve_body($fund));
        }
       
        
        if ($funddata != null && $funddata->Err === false){
                    
            
            global $wpdb;
            $loyae_generated_data = $wpdb->prefix . 'loyae_generated_data';


            ////////////////   For testing
                //$wpdb->query("DROP TABLE IF EXISTS $loyae_generated_data");
            ///////////////


            $charset_collate = $wpdb->get_charset_collate();
            
            echo "<div style='text-align:center; font-family: arial'><span style='color:green;font-size: 25px;'>Thank You!</span><br/><br/><span style='color:red;font-size: 25px;'><b>DO NOT CLOSE THIS PAGE UNTIL IT SAYS, FINISHED LOADING (this may take a very long time for large websites)</b></span><br/><br/>
            <span style='color:black;font-size: 20px;'>PLEASE CONTACT US AT contact@loyae.com IF ISSUES ARISE</span><br/><br/>
            <span style='color:black;font-size: 20px;'>Sometimes Loyae will deliberately avoid placing some metadata on pages with not enough content. When this happens, please contact us for a partial refund</span><br/><br/>
            <br/><span style='font-size: 30px'>LOGS:</span><br/><br/></div>";
            $data_entries = array("description", "og_description", "og_image", "og_image_alt", "og_image_width", "og_image_height", "og_image_type", "og_site_name", "og_title", "og_url", "og_type", "og_keywords", "keywords", "theme_color", "twitter_card", "twitter_title", "twitter_description", "twitter_image", "twitter_image_alt", "twitter_url", "apple_mobile_web_app_status_bar_style", "apple_mobile_web_app_title", "optimized", "alt");
            $entry = "";
            for($i = 0; $i < count($data_entries); $i++){
                $entry .= "\nloyae_".$data_entries[$i]." text DEFAULT '' NOT NULL,";
            }
            
            $sql = "CREATE TABLE $loyae_generated_data (
            ID int NOT NULL,".$entry."
            PRIMARY KEY (ID)
            ) $charset_collate;";
            
            require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
            dbDelta( $sql );





            status_header(200);
            
            echo '<br/><br/>';
            echo "\n Date: " . date('Y-m-d H:i:s') . "<br/><br/>";

            $keys = array_keys($_POST); 
                $form_id=(int)substr($keys[0], 0, strpos($keys[0], "_"));
                foreach($keys as $p){ //for each page ID that was selected in the form
                    $id = (int)substr($p, 0, strpos($p, "_"));

                    if($id != $form_id){
                        
                        if($wpdb->get_var($wpdb->prepare("SELECT COUNT(*) FROM $loyae_generated_data WHERE ID = %d", $id))==0){
                            $generated_data = get_generated_meta($id, $_POST['email'], (string)($_POST['number']));
                            //echo "THING:".$generated_data["ID"];
                            if($generated_data["ID"] != null){
                                print_r($generated_data);
                                echo "<br/><br/><br/>";
                                $wpdb->insert($loyae_generated_data, $generated_data);
                            }
                        }

                    }
                    
                }

                echo "<br/><br/>";
                echo '<div style="text-align: center;"><a href="'.get_home_url().'" style="border: 0; background-color: lightcoral; border-radius: 10px; height: 30px; width: 50px; padding: 10px; color: white;text-decoration: none;">Home</a></div>';
                echo "<br/><br/>";




                echo '<br/><br/>';
                $result = $wpdb->get_results ( "SELECT * FROM ".$loyae_generated_data );
                 print_r($result);
                 
    


                exit("FINISHED LOADING");

            
            
        } else {
            echo 'There was an error with your payment';
        }
    } else {
        echo 'Please properly enter your card information in its entirety';
    }
}





function loyae_add_meta_tag() {
    global $wpdb;
    $loyae_generated_data = $wpdb->prefix . 'loyae_generated_data';

        if(is_single() or is_page()){
            $loyae_alt = NULL;
         
            $q = 'SELECT * FROM ' . $loyae_generated_data . ' WHERE ID = '. get_the_ID();
            $meta = ($wpdb->get_results($q))[0] ?? NULL;
    

            if($meta != NULL){
            
                echo '<!--LOYAE: the following meta data has been generated by loyae.com-->'."\n";
                //If it's <NULL> then don't put it in
                if($meta->loyae_description!="<NULL>"){
                    echo '<meta name="description" content="' . $meta->loyae_description . '" />' . "\n";
                }
                if($meta->loyae_og_description!="<NULL>"){
                    echo '<meta property="og:description" content="' . $meta->loyae_og_description . '" />' . "\n";
                }
                if($meta->loyae_og_image!="<NULL>"){
                    echo '<meta property="og:image" content="' . $meta->loyae_og_image . '" />' . "\n";
                }
                if($meta->loyae_og_image_alt!="<NULL>"){
                    echo '<meta property="og:image:alt" content="' . $meta->loyae_og_image_alt . '" />' . "\n";
                }
                if($meta->loyae_og_image_width!="<NULL>"){
                    echo '<meta property="og:image:width" content="' . $meta->loyae_og_image_width . '" />' . "\n";
                }
                if($meta->loyae_og_image_height!="<NULL>"){
                    echo '<meta property="og:image:height" content="' . $meta->loyae_og_image_height . '" />' . "\n";
                }
                if($meta->loyae_og_image_type!="<NULL>"){
                    echo '<meta property="og:image:type" content="' . $meta->loyae_og_image_type . '" />' . "\n";
                }
                if($meta->loyae_og_site_name!="<NULL>"){
                    echo '<meta property="og:site_name" content="' . $meta->loyae_og_site_name . '" />' . "\n";
                }
                if($meta->loyae_og_title!="<NULL>"){
                    echo '<meta property="og:title" content="' . $meta->loyae_og_title . '" />' . "\n";
                }
                if($meta->loyae_og_url!="<NULL>"){
                    echo '<meta property="og:url" content="' . $meta->loyae_og_url . '" />' . "\n";
                }
                if($meta->loyae_og_type!="<NULL>"){
                    echo '<meta property="og:type" content="' . $meta->loyae_og_type . '" />' . "\n";
                }
                if($meta->loyae_og_keywords != "<NULL>"){
                    echo '<meta property="og:keywords" content="' . $meta->loyae_og_keywords . '" />' . "\n";
                }
                if($meta->loyae_keywords!="<NULL>"){
                    echo '<meta name="keywords" content="' . $meta->loyae_keywords . '" />' . "\n";
                }
                if($meta->loyae_theme_color!="<NULL>"){
                    echo '<meta name="theme-color" content="' . $meta->loyae_theme_color . '" />' . "\n";
                }
                if($meta->loyae_twitter_card!="<NULL>"){
                    echo '<meta name="twitter:card" content="' . $meta->loyae_twitter_card . '" />' . "\n";
                }
                if($meta->loyae_twitter_title!="<NULL>"){
                    echo '<meta name="twitter:title" content="' . $meta->loyae_twitter_title . '" />' . "\n";
                }
                if($meta->loyae_twitter_description!="<NULL>"){
                    echo '<meta name="twitter:description" content="' . $meta->loyae_twitter_description . '" />' . "\n";
                }
                if($meta->loyae_twitter_image!="<NULL>"){
                    echo '<meta name="twitter:image" content="' . $meta->loyae_twitter_image . '" />' . "\n";
                }
                if($meta->loyae_twitter_image_alt!="<NULL>"){
                    echo '<meta name="twitter:image:alt" content="' . $meta->loyae_twitter_image_alt . '" />' . "\n";
                }
                if($meta->loyae_twitter_url!="<NULL>"){
                    echo '<meta name="twitter:url" content="' . $meta->loyae_twitter_url . '" />' . "\n";
                }
                if($meta->loyae_apple_mobile_web_app_status_bar_style!="<NULL>"){
                    echo '<meta name="apple-mobile-web-app-status-bar-style" content="' . $meta->loyae_apple_mobile_web_app_status_bar_style . '" />' . "\n";
                }
                if($meta->loyae_apple_mobile_web_app_title!="<NULL>"){
                    echo '<meta name="apple-mobile-web-app-title" content="' . $meta->loyae_apple_mobile_web_app_title . '" />' . "\n";
                }
                if($meta->loyae_optimized!="<NULL>"){
                    echo '<meta property="loyae:optimized" content="'.$meta->loyae_optimized.'" />' . "\n";
                }

                echo '<meta name="generator" content="https://loyae.com" />' . "\n";

                echo '<!--LOYAE END-->'."\n";

                $loyae_alt = unserialize($meta->loyae_alt);
                //echo "LOYAE ALT IN ADD META BEFORE }" . $loyae_alt;
                //print_r($loyae_alt);
            }
   
            //echo "LOYAE ALT IN ADD META AFTER }" . $loyae_alt;
            //print_r($loyae_alt);

        
            $post_content = get_post_field('post_content', get_the_ID());

            
            $dom = new DOMDocument();
            libxml_use_internal_errors(true);
            $dom->loadHTML($post_content);
            libxml_use_internal_errors(false);

            
            $images = $dom->getElementsByTagName('img');

            
            foreach ($images as $image) {
                $src = $image->getAttribute('src');
                if($loyae_alt != null && array_key_exists($src, $loyae_alt)){
                    $image->setAttribute('alt', $loyae_alt[$src]);
                }
            }

            
            $updated_post_content = $dom->saveHTML();

            
            $update_post_args = array(
                'ID'           => get_the_ID(),
                'post_content' => $updated_post_content,
            );

            remove_action( 'post_updated', 'wp_save_post_revision' );
            wp_update_post($update_post_args);
            add_action( 'post_updated', 'wp_save_post_revision' );
        }
}




add_action( 'wp_head', 'loyae_add_meta_tag');



?>