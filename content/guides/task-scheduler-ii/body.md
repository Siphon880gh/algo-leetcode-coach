## Jump instead of waiting

1. `day = 0`, `last = {}`.
2. For each `t`: `day = day + 1`; if `t ∈ last`, `day = max(day, last[t] + space + 1)`; `last[t] = day`.
3. Return `day`.

Examples → 9, 6. Checked against a day-by-day simulation on 300 random cases.

Tasks must run in order, so doing each as early as allowed never delays a later one. 10^5 tasks of one type with space = 10^5 take 10,000,000,000 days, so use 64-bit.

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
