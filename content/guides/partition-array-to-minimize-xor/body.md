## DP

1. pre = prefix XORs; f[0][0] = 0, everything else ∞.
2. f[i][j] = min over h of max(f[h][j − 1], pre[i] ^ pre[h]).
3. Answer f[n][k].

Examples → 1, 2, 0. Checked against every set of cuts on 500 random arrays.

Binary search on the answer with greedy cuts (cut as soon as the running XOR fits): [1, 3, 5], k = 2 → 6 instead of 5. XOR is not monotonic, so cutting early can hurt.

Time: O(n² · k)  
Space: O(n · k)

> [!ui-builder] Mini game
> INPUT_TOPIC: Theory or problem
> INPUT_SLUG: Folder slug (kebab-case)
> PROMPT:
> Use the harness skill at .agents/skills/harness to create a mini-game in this Leetcode Practice Coach IDE app that teaches [INPUT_TOPIC]. Place it under content/games/[INPUT_SLUG]/. Follow meta.php + index.html. Use .agents/skills/game-development-sickn33 for web/2d craft if needed.

> [!ui-builder] Step-by-step
> INPUT_TOPIC: Theory or problem
> INPUT_SLUG: Folder slug (kebab-case)
> PROMPT:
> Use the harness skill at .agents/skills/harness to create a step-by-step session for [INPUT_TOPIC] under content/coaching/[INPUT_SLUG]/. Include branching choices with clear labels, at least one wrong-path leaf with rewind_to, and a success leaf. Follow the tree.php contract so Step back and the Path visualizer work.
