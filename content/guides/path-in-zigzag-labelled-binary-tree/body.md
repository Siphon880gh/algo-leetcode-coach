## Reflect within the row

Row `d` holds labels `2^(d−1)` to `2^d − 1`. Start with `d` = bit length of `label`.

While `label ≥ 1`:

- Append `label`.
- `lo = 2^(d−1)`, `hi = 2^d − 1`; `label = (lo + hi − label) // 2`; `d −= 1`.

Reverse the list.

`lo + hi − label` is the label at the mirrored position in the same row; halving it gives the parent's label in the zigzag tree.

Do not build the tree; labels reach 10⁶. Do not halve without reflecting; that gives the path in a normal heap.

Time: O(log label)  
Space: O(log label)

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
