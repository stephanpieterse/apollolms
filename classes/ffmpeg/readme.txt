
    ______ ______                                  __            _  __     __
   / ____// ____/____ ___   ____   ___   ____ _   / /_   __  __ (_)/ /____/ /
  / /_   / /_   / __ `__ \ / __ \ / _ \ / __ `/  / __ \ / / / // // // __  / 
 / __/  / __/  / / / / / // /_/ //  __// /_/ /  / /_/ // /_/ // // // /_/ /  
/_/    /_/    /_/ /_/ /_// .___/ \___/ \__, /  /_.___/ \__,_//_//_/ \__,_/   
                        /_/           /____/                                 


                build: ffmpeg-2.5.1-64bit-static.tar.xz
              version: 2.5.1

 
                  gcc: 4.8.3
                 yasm: 1.3.0

               libass: 0.12.0
               libvpx: 1.3.0-5139-gb716614
              libx264: 0.142.62 24e4fed
              libx265: 1.4+209-6ba7be7b1697
              libxvid: 1.3.3-1
              libwebp: 0.4.2
            libgnutls: 3.2.21
            libtheora: 1.1.1
          libfreetype: 2.5.2-2
          libopenjpeg: 1.5.2 

              libopus: 1.1-2
             libspeex: 1.2
            libvorbis: 1.3.4-2
           libmp3lame: 3.99.5
         libvo-aacenc: 0.1.3-1
       libvo-amrwbenc: 0.1.3-1
    libopencore-amrnb: 0.1.3-2.1
    libopencore-amrwb: 0.1.3-2.1

      For HEVC/H.265 encoding:  ffmpeg -h encoder=libx265
                                http://x265.readthedocs.org/en/default/cli.html#standalone-executable-options

      For AVC/H.264 encoding:   ffmpeg -h encoder=libx264
                                http://mewiki.project357.com/wiki/X264_Settings


      Notes: ffmpeg-10bit is built with 10-bit AVC/H.264 encoding support.

             A limitation of statically linking glibc is the loss of DNS resolution. Installing
             nscd through your package manager will fix this or you can use
             "ffmpeg -i http://<ip address here>/" instead of "ffmpeg -i http://example.com/"


      This build should be stable but if you do run into problems *DO NOT* file a bug report against           
      it! You should first check out the source from git://source.ffmpeg.org/ffmpeg.git, build it, and           
      see if the problem persists. If so, then and only then should you file a bug report using the
      version you compiled.

      The source code for FFmpeg and all libs are available upon request.

      Donate a few bucks if you've found this build helpful. 
      Paypal tinyurl: http://goo.gl/1Ol8N


      email: john.vansickle@gmail.com
      irc: relaxed @ irc://irc.freenode.net #ffmpeg #libav
      url: http://johnvansickle.com/ffmpeg/
