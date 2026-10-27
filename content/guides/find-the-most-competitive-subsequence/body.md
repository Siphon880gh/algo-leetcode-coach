## Pop while you can afford it

1. For `i, x`: while stack top `> x` and `len(stack) + (n − i) > k`: pop.
2. If `len(stack) < k`: push `x`.
3. Return the stack.

`[3,5,2,6]`, 2 → `[2,6]`. `[2,4,3,3,5,4,9,6]`, 4 → `[2,3,3,4]`.

The remaining-count check keeps the answer length k. Do not pop on equal values; equal values do not make the sequence smaller.

Time: O(n)  
Space: O(k)

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
