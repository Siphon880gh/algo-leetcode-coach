## Prefix DP

1. `P` = binary strings of 5^0 … 5^6: 1, 101, 11001, 1111101, 1001110001, 110000110101, 11110100001001.
2. `dp[0] = 0`; `dp[i] = min(dp[i − |p|] + 1)` over p in P that end s at i.
3. Return `dp[n]`, or −1 if unreachable.

Examples → 2, 3, −1. Checked against trying every partition on 300 random strings.

Every listed string starts with 1, so leading zeros never sneak in; a string starting with 0, like example 3, is impossible.

Time: O(n · 7)  
Space: O(n)

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
