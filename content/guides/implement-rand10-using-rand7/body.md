## Rejection sampling on a 7 × 7 grid

Two calls pick a cell in a 7 × 7 grid uniformly: `x = (rand7() − 1) · 7 + rand7()` is uniform on `1..49`. The first 40 values split evenly into four copies of `1..10`. If `x <= 40`, return `(x − 1) % 10 + 1`. Otherwise reject and draw again. Every accepted value is equally likely, so the output is uniform.

Each round uses 2 calls and succeeds with probability 40/49. Expected calls ≈ `2 · 49 / 40 ≈ 2.45`. To use fewer calls, recycle the rejected value: `x − 40` is uniform on `1..9`; combine it with another `rand7()` to get `1..63`, keep `1..60`, and so on.

Linked List Random Node (382) and Random Pick with Weight (528) are other sampling problems.

Do not use `rand7() + rand7()` — sums near the middle are more likely. Do not use `rand7() % 10` or scale with multiplication — 7 outcomes cannot spread evenly over 10.

Time: O(1) expected  
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
