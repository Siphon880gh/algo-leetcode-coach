## Masks of covered skills

1. Map each skill to a bit; `pm[i]` = mask of person `i`.
2. `dp = {0: []}`. For each person `i`, for each `(mask, team)` in a snapshot of `dp`:
   - `nm = mask | pm[i]`.
   - If `nm` is not in `dp` or `len(dp[nm]) > len(team) + 1`, set `dp[nm] = team + [i]`.
3. Return `dp[full mask]`.

Store, instead of whole lists, the previous mask and the person added, then rebuild the team at the end to save memory.

Skip people whose skills are a subset of someone else's; they never help. Do not search subsets of people; there can be 60 of them.

Time: O(people · 2^skills)  
Space: O(2^skills)

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
