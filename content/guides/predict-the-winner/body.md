## Track the lead, not two scores

Let `f[i][j]` be the most the player to move can lead by (their total minus the opponent's) on `nums[i..j]`. Taking `nums[i]` gives `nums[i]` now, after which the opponent leads by `f[i+1][j]` on the rest — so the mover's lead is `nums[i] − f[i+1][j]`. Same for the right end. `f[i][j] = max(nums[i] − f[i+1][j], nums[j] − f[i][j−1])`, with `f[i][i] = nums[i]`. Fill by increasing length. Player 1 wins if `f[0][n−1] >= 0`.

A memoized recursion on `(i, j)` is the same thing. A 1D array works too if you fill `i` from right to left.

Stone Game (877) is this game with an even count and an odd total, where player 1 always wins — but the DP is the general proof. Can I Win (464) uses a bitmask state instead of an interval.

Do not track only player 1's score — whose turn it is changes the recurrence. Do not forget the tie rule (`>= 0`, not `> 0`). Plain recursion without memo is O(2^n), fine for 20 but the DP is O(n²).

Time: O(n²)  
Space: O(n²) (O(n) with a 1D array)

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
