## Batch the subtractions

1. While both are non-zero: make `a ≥ b`; `ops += a / b`; `a = a mod b`.
2. Return `ops`.

Examples → 3, 1. Checked against step-by-step subtraction on 300 random pairs.

Subtracting `b` from `a` repeats until `a < b`, which is exactly `a / b` steps ending at `a mod b`. Plain simulation also passes here (values ≤ 10^5), but the quotient form is O(log).

Time: O(log max)  
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
