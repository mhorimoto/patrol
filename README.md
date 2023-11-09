# patrol

装置見守りシステム

V2.00

# ドア開閉検知と停電検知

LEDの点灯により異常検知の表示をおこなう。
このため、フィールドでの簡単な検査が可能となった。

## ドア開閉検知

リードスイッチをドアに取り付けてPA7がLだとGNDに落ちているのでドアCLOSE。PA7がHだとドアOPEN。

## 停電検知

ACコイルリレーにより検知すべき電源にコンセントで給電をうけてコイル通電させて端子をMAKEさせます。PG8はNC(ノーマルコネクト)端子としてGND側と接続されているので、MAKEされるとOPENになります。
PG8はPULLUP端子なのでPG8はHになります。

# シリアルポート

L2SWとOLTのシリアルコンソールインタフェース用にシリアルポートを用意する。

## L2SW用

D-LinkのDGSシリーズに接続するので、3.3Vから5Vへの電圧変換インタフェースを介して接続する。ttyS3で115200bps

## OLT用

三菱電機のAS-1000/2000シリーズに接続するもので3.3Vでも動くので電圧変換インタフェースは介さない。ttyS1で9600bps

# 回路構成

回路構成については後ほど記す。

# API

サーバー側に置くWeb APIのプログラム

# 必要なライブラリ

GPIOを用いるため、pyA20を必要とする。

https://github.com/duxingkei33/orangepi_PC_gpio_pyH3.git

これをコンパイルするために、python3.x-dev が必要となる。

    apt install python3.8-dev

