## Where does the shortest stick go?

`dp[i][j] = dp[i − 1][j − 1] + (i − 1) · dp[i − 1][j]`, `dp[0][0] = 1`, mod 1e9+7.

- First position: visible, the rest is a smaller instance with `j − 1` visible.
- Any of the other `i − 1` positions: hidden, and it never blocks anyone.

`(3, 2)` → 3. `(5, 5)` → 1. `(20, 11)` → 647427950.

These are unsigned Stirling numbers of the first kind. A rolling 1-D array works if `j` runs downward.

Time: O(n · k)  
Space: O(n · k), or O(k) rolling

> [!ui-builder] Mini game
> INPUT_TOPIC: Theory or problem
> INPUT_SLUG: Folder slug (kebab-case)
> PROMPT:
> Use the harness skill at .agents/skills/harness to create a mini-game in this Algo Learning IDE app that teaches [INPUT_TOPIC]. Place it under content/games/[INPUT_SLUG]/. Follow meta.php + index.html. Use .agents/skills/game-development-sickn33 for web/2d craft if needed.

> [!ui-builder] Step-by-step
> INPUT_TOPIC: Theory or problem
> INPUT_SLUG: Folder slug (kebab-case)
> PROMPT:
> Use the harness skill at .agents/skills/harness to create a step-by-step session for [INPUT_TOPIC] under content/coaching/[INPUT_SLUG]/. Include branching choices with clear labels, at least one wrong-path leaf with rewind_to, and a success leaf. Follow the tree.php contract so Step back and the Path visualizer work.
