## Prefix DP

1. `dp[0] = 0`.
2. For `i = 1 … n`: `dp[i] = dp[i − 1] + 1`; for each word w ending at i, `dp[i] = min(dp[i], dp[i − |w|])`.
3. Return `dp[n]`.

Examples → 1, 3.

Greedily taking the longest word at each position fails: abbbba with [b, bb, ba] → 2 instead of 1, because bb then bb leaves the final a stranded. A trie over reversed words speeds up the inner loop, but the limits of 50 make a plain check fine.

Time: O(n · total word length)  
Space: O(n)

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
