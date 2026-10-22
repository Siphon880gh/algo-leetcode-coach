# Curated LeetCode lists

`lists.json` feeds the **Lists** page (`lists/index.php`): Blind 75 and NeetCode 150, grouped by NeetCode's pattern names (Arrays & Hashing, Two Pointers, Sliding Window, Trees, …).

Sources:

- **NeetCode 150** — NeetCode's own problem data behind [neetcode.io/practice](https://neetcode.io/practice): [`neetcode-gh/leetcode/.problemSiteData.json`](https://raw.githubusercontent.com/neetcode-gh/leetcode/main/.problemSiteData.json) (`neetcode150: true`).
- **Blind 75** — the [original Blind post](https://www.teamblind.com/post/New-Year-Gift---Curated-List-of-Top-75-LeetCode-Questions-to-Save-Your-Time-OaM1orEU). It matches NeetCode's `blind75` flag except the post lists Combination Sum IV (377) where NeetCode lists Combination Sum (39); `build.py` follows the post.

Rebuild (fetches the NeetCode data when no path is given):

```bash
python3 context-leetcode-lists/build.py
```

The page maps each problem to this app's Algo Guide, Step-by-step session, and mini game by LeetCode number, and marks problems with none as "Not in app yet".
