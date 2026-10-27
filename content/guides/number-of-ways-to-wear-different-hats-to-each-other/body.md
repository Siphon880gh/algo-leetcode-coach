## Mask over the small side

1. `who[h]` = people liking hat `h`.
2. `dp[mask]` = ways using hats so far; `dp[0] = 1`.
3. For each hat `h`, for masks in descending order, for each `p` in `who[h]` not in `mask`: `dp[mask | 1<<p] += dp[mask]` (mod 1e9+7).
4. Return `dp[full]`.

`[[3,4],[4,5],[5]]` → 1. `[[3,5,1],[3,5]]` → 4. Four people liking `[1,2,3,4]` → 24.

Do not mask over hats (2^40). Iterate masks downward so a hat is used at most once.

Time: O(40 · 2^n · n)  
Space: O(2^n)

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
