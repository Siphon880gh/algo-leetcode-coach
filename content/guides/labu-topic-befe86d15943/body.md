## Tiny example

List problem patterns with tiny cues:

| Pattern | Cue | Sketch |
|---------|-----|--------|
| Reverse | “reverse k nodes” | save next, flip, advance |
| Merge | two sorted lists | dummy + pick smaller head |
| Cycle | “might loop” | fast/slow meet |
| Intersect | shared suffix | switch-head pointers |
| Partition | pivot value | two buckets then join |

Recognize the cue, then reuse the pointer sketch.


## How

1. Match the prompt to a pattern row
2. Draw the pointer moves
3. Code with saved `next` / dummy as needed


## Trap

Mixing cycle detection with intersect logic in one pointer soup without stating which pattern.

**Fix:** Name the pattern first; keep one sketch.

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
