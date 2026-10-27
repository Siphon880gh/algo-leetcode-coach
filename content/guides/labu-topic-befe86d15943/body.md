## Tiny example

Linked list problem patterns and the clue that points to each one:

| Pattern | Clue | Sketch |
|---------|------|--------|
| Reverse | "reverse k nodes" | save next, flip the link, advance |
| Merge | two sorted lists | dummy head, then pick the smaller head |
| Cycle | "might loop" | fast and slow pointers meet |
| Intersect | the lists share a tail | each pointer switches to the other head at the end |
| Partition | a pivot value | build two lists, then join them |

Recognize the clue, then reuse the pointer sketch.

## How

1. Match the problem statement to a row in the table.
2. Draw the pointer moves.
3. Write the code, saving `next` and using a dummy head where needed.

## Trap

Mixing cycle detection and intersection logic in one tangle of pointers without deciding which pattern you are using.

**Fix:** Name the pattern first, and stick to one sketch.

**Time:** usually O(n) · **Space:** O(1)

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
