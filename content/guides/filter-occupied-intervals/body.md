## Merge and cut

1. Sort by start. Extend the last merged interval when start ≤ end + 1, else start a new one.
2. For each merged [s, e]: s < freeStart → keep [s, min(e, freeStart − 1)]; e > freeEnd → keep [max(s, freeEnd + 1), e].

Examples → [[2, 6], [12, 12], [14, 16]], [[1, 2]]. Checked against listing every point on 2,000 random cases.

Merging only overlapping intervals: constructed check (run in code) [[1, 1], [2, 2]] with free [5, 5] → [[1, 1], [2, 2]] instead of [[1, 2]].

Time: O(m log m)  
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
