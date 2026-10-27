## At most two candidates

1. Candidates: `(t / 60, t mod 60)` and `(t / 60 − 1, t mod 60 + 60)`; keep those with both parts in `0 … 99`.
2. Write `100·m + s` without leading zeros.
3. Cost: start at `startAt`; for each digit add `moveCost` if it differs from the finger position, then `pushCost`.
4. Return the cheaper.

Examples → 6, 6. Checked against all 9999 pushes on 300 random cases.

Seconds can only exceed 59 by borrowing one minute, and borrowing two would need 120+ seconds, which is above 99. Pushing leading zeros only adds cost.

Time: O(1)  
Space: O(1)

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
