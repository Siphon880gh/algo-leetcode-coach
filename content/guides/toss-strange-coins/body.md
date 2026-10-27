Given the probability that each coin lands heads, toss every coin once and return the probability that exactly `target` coins show heads. For instance, `[0.5,0.5]` with `target = 1` gives 0.5, and `[0.4]` with `target = 1` gives 0.4. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Heads count DP

1. `dp = [1] + [0] * target`.
2. For each `p`: for `k` from `target` down to 1, `dp[k] = dp[k] · (1 − p) + dp[k − 1] · p`; then `dp[0] *= (1 − p)`.
3. Return `dp[target]`.

Going downward keeps `dp[k − 1]` from this coin's update out of the formula.

Do not enumerate all outcomes; that is 2ⁿ. Do not update `k` upward with one array; a coin would count twice.

Time: O(n · target)  
Space: O(target)

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
