## What survives is a common subsequence

After the deletions, both strings equal some common subsequence. Fewer deletions means a longer one, so

`answer = m + n − 2 · LCS(word1, word2)`.

LCS DP: `f[i][j]` for the prefixes of length `i` and `j`. If `word1[i − 1] == word2[j − 1]`, `f[i][j] = f[i − 1][j − 1] + 1`; otherwise `f[i][j] = max(f[i − 1][j], f[i][j − 1])`.

You can also count deletions directly: `g[i][0] = i`, `g[0][j] = j`; on a match `g[i][j] = g[i − 1][j − 1]`, else `1 + min(g[i − 1][j], g[i][j − 1])`.

Edit Distance (72) adds replace; Longest Common Subsequence (1143) is the core DP.

Do not allow a replace step; only deletions are allowed. Do not compute the longest common substring; the kept letters do not have to be adjacent.

Time: O(m · n)  
Space: O(m · n), or O(n) with one rolling row

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
