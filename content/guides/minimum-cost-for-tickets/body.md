## A pass ending today

Let `last = days[-1]` and mark the travel days in a set.

`dp[0] = 0`. For `d` from 1 to `last`:

- Not a travel day: `dp[d] = dp[d − 1]`.
- Travel day: `dp[d] = min(dp[d − 1] + costs[0], dp[max(0, d − 7)] + costs[1], dp[max(0, d − 30)] + costs[2])`.

Return `dp[last]`.

Thinking of each pass as ending today (instead of starting) keeps the recurrence simple: a 7-day pass bought on day `d − 6` covers up to `d`.

Do not assume the longer pass is always cheaper per day; costs can be anything. Do not pick passes greedily by the next few days.

Time: O(365)  
Space: O(365)

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
