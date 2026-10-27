## Fix each pair as it forms

1. `kept = 0`, `del = 0`.
2. For each `x`: if `kept` is odd and `x` equals the last kept value, `del += 1`; else keep it (`kept += 1`).
3. Return `del + (kept mod 2)`.

Examples → 1, 2. Checked against trying every subset of deletions on 400 small arrays.

Deleting the second copy of a clashing pair is never worse than deleting earlier, since it keeps the pair start fixed and shifts everything after it the same way.

Time: O(n)  
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
