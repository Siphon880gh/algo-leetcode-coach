## Alternate levels

`depth = 0`. For each character:

- `(`: `depth += 1`; assign `depth % 2`.
- `)`: assign `depth % 2`; `depth −= 1`.

Each matching pair gets the same label, so both subsequences stay valid. Consecutive levels go to different strings, so each gets about half the levels: `max(depth(A), depth(B)) = ceil(D / 2)`, where `D` is the original depth.

Any valid split with that maximum is accepted, so the labels may differ from the examples.

Do not assign by position parity; a pair's two halves could land in different strings. Do not build the two strings explicitly; only the labels are needed.

Time: O(n)  
Space: O(1) beyond the output

> [!ui-builder] Mini game
> INPUT_TOPIC: Theory or problem
> INPUT_SLUG: Folder slug (kebab-case)
> PROMPT:
> Use the harness skill at .agents/skills/harness to create a mini-game in this Algo Learning IDE app that teaches [INPUT_TOPIC]. Place it under content/games/[INPUT_SLUG]/. Follow meta.php + index.html. Use .agents/skills/game-development-sickn33 for web/2d craft if needed.

> [!ui-builder] Step-by-step
> INPUT_TOPIC: Theory or problem
> INPUT_SLUG: Folder slug (kebab-case)
> PROMPT:
> Use the harness skill at .agents/skills/harness to create a step-by-step session for [INPUT_TOPIC] under content/coaching/[INPUT_SLUG]/. Include branching choices with clear labels, at least one wrong-path leaf with rewind_to, and a success leaf. Follow the tree.php contract so Step back and the Path visualizer work.
