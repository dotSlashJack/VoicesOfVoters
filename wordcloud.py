from PIL import Image
import numpy as np
from wordcloud import WordCloud
import matplotlib.pyplot as plt
from wordcloud import STOPWORDS
import pandas as pd

response_text= ''
responses = pd.read_csv("submissions.csv", header=0)
for i, row in responses.iterrows():
    response_text=response_text+' '+row[1]

mask = np.array(Image.open('VOTE_wc_template.png'))

wc = WordCloud(stopwords=STOPWORDS, font_path='/Users/jack/github/vote/KaushanScript-Regular.otf',
               mask=mask, background_color="white",
               max_words=2000, max_font_size=256,
               random_state=42, width=mask.shape[1],
               height=mask.shape[0], contour_width=4,
               contour_color='black')
wc.generate(response_text)
plt.imshow(wc, interpolation="bilinear")
plt.axis('off')
figure = plt.gcf()
figure.set_size_inches(8, 6)
plt.savefig("vote_wc.png", dpi=300, bbox_inches='tight')
plt.show()
