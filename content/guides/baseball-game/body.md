## Record what is still valid

Use a stack of scores:

- An integer: push it.
- `"+"`: push `stack[−1] + stack[−2]`.
- `"D"`: push `2 · stack[−1]`.
- `"C"`: pop. The previous scores are valid again for later `+` and `D`.

Return `sum(stack)`.

The input guarantees each operation has enough scores, so no extra checks are needed.

Do not keep only a running total; after a `"C"` you need the earlier scores back. Do not parse with `isdigit`; negative scores like `"-2"` start with a minus sign.

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
