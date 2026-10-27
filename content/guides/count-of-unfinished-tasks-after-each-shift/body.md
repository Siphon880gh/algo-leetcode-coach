## Simulate

1. s = prefix sums of tasks; i = current task, cur = time spent on it.
2. Shift < tasks[i] − cur → cur += shift; answer m − i.
3. Else t = shift − (tasks[i] − cur). t ≥ s[m] − s[i + 1] → answer 0, restart at i = 0, cur = 0.
4. Else find the largest l with s[l] − s[i + 1] ≤ t; i = l, cur = t − (s[l] − s[i + 1]); answer m − l.

Examples → [0, 2, 1], [0, 2, 0], [2, 0, 2]. Checked against unit-by-unit simulation on 3,000 random cases.

Carrying the unused time of a finished round into the next shift: example 2 → [0, 0, 0] instead of [0, 2, 0].

Time: O(m + q log m)  
Space: O(m)

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
