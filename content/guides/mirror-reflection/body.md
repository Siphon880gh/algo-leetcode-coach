## A straight line through mirrored rooms

Every bounce off the left or right wall can be replaced by a mirrored copy of the room, so the ray goes straight. It rises `q` per room width and first reaches a corner when its height is a multiple of both `p` and `q`: `L = lcm(p, q)`.

- `L / p` is how many rooms tall the path is.
- `L / q` is how many room widths it crossed.

Then:

- `L / p` even → it ends on a bottom corner of the original: receptor **0**.
- otherwise `L / q` even → it ends on the left wall: receptor **2**.
- otherwise → receptor **1**.

Equivalently, divide `p` and `q` by 2 while both are even; then odd/odd → 1, `p` odd and `q` even → 0, `p` even and `q` odd → 2.

Do not trace bounces with floating point. Do not use `p · q` as the meeting height; it may skip the first corner.

Time: O(log min(p, q))  
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
