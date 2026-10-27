## Unbounded knapsack counting

`f[j]` = ways to make `j`. Start `f[0] = 1` (the empty combination). For each coin `c`, for `j` from `c` up to `amount`: `f[j] += f[j − c]`. Going **up** lets the same coin be reused (unbounded).

The loop order matters. With coins outside, every combination is built in one fixed coin order, so `1+2` and `2+1` count once. Putting `amount` outside and coins inside counts ordered sequences — that is Combination Sum IV (377).

Coin Change (322) asks for the fewest coins with a `min` instead of a sum.

Do not loop `j` downward — that limits each coin to once (0-1 knapsack). Do not start with `f[0] = 0`, or nothing ever counts.

Time: O(coins · amount)  
Space: O(amount)

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
