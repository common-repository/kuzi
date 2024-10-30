Array.prototype.shuffle = function() {
    var i = this.length;
    while (i) {
        var j = Math.floor(Math.random() * i);
        var t = this[--i];
        this[i] = this[j];
        this[j] = t;
    }
    return this;
};

function ViewModel(ReelAry) {
    var self = this;
    if (ReelAry.length < 21) {
        var minNum = 0;
        var plsNum = ReelAry.length;
        while (ReelAry.length < 21) {
            m = Math.floor(Math.random() * plsNum) + minNum;
            ReelAry.push(ReelAry[m]);
        }
    }
    ReelAry.shuffle();
    self.Reel = ko.observableArray(ReelAry);
    self.ReelTop = ko.observable(self.Reel()[4]);
    self.ReelT_M = ko.observable(self.Reel()[3]);
    self.ReelMid = ko.observable(self.Reel()[2]);
    self.ReelM_B = ko.observable(self.Reel()[1]);
    self.ReelBtm = ko.observable(self.Reel()[0]);
    self.btnStop = ko.observable(false);
    self.btnLabel = ko.observable("スタート");
    self.aryReel = ko.observable(false);
    self.lotReel = ko.observable(true);
    self.checkLabel = ko.observable("リールの確認");
    self.checkReel = function() {
        if (self.aryReel() == false) {
            self.checkLabel("リールを閉じる");
        }
        else {
            self.checkLabel("リールの確認");
        }
        self.lotReel(!self.lotReel());
        self.aryReel(!self.aryReel());
    };
    self.wait2 = 0.01;
    self.ratio = 0.5;
    
    self.loop = function() {
        if (self.btnLabel() == "スタート") {
            self.num = Math.floor(Math.random() * 3);
            self.btnLabel("ストップ");
            self.btnStop(false);
            self.wait = 30;
            self.timer = setInterval(self.loopReel, self.wait);
        }
        else {
            self.btnStop(true);
            clearInterval(self.timer);
            self.timer = setTimeout(self.loopReel, 0);
        }
    };
    
    self.loopReel = function() {
        self.Reel().push(self.Reel()[0]);
        self.Reel().splice(0, 1);
        self.ReelTop(self.Reel()[4]);
        self.ReelT_M(self.Reel()[3]);
        self.ReelMid(self.Reel()[2]);
        self.ReelM_B(self.Reel()[1]);
        self.ReelBtm(self.Reel()[0]);
        if (self.btnStop() == true && self.wait < 500) {
            self.wait = self.wait * (1 + self.ratio);
            self.ratio = self.ratio + self.wait2;
            self.timer = setTimeout(self.loopReel, self.wait);
        }
        else if (self.btnStop() == true) {
            if (0 < self.num) {
                self.wait = self.wait * (1 + self.ratio);
                self.timer = setTimeout(self.loopReel, self.wait);
                self.num = self.num - 1;
            }
            else {
                self.btnLabel("スタート");
                self.btnStop(false);
            }
        }
    };
}
