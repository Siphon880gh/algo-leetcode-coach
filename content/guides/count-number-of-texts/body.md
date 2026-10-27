## Last letter length

1. `dp[0] = 1`.
2. For `i = 1 … n`: `L = 4` if the key is 7 or 9, else 3; for `j = 1 … L` while `pressedKeys[i − j] = pressedKeys[i − 1]`: `dp[i] += dp[i − j]`.
3. Return `dp[n] mod 10^9 + 7`.

Examples → 8, 82876089.

Different keys never merge into one letter, so the DP only looks back within the current run. Keys 7 and 9 carry four letters: 77777 gives 15, while a three-letter rule would give 13.

Time: O(n)  
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
