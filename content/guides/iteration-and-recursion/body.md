## Tiny example

Sum `1…n`.

Iterative: `s=0; for i in 1…n: s+=i` — one frame, O(1) extra space.

Recursive: `sum(n)=n+sum(n-1)` — n stacked frames, O(n) space (unless tail-call optimized, which many languages lack).


## How

1. Same mathematical recurrence can be a loop or recursion
2. Prefer iteration when depth would be large and no tree structure needs it
3. Prefer recursion when the problem tree is natural (trees, D&C)


## Trap

Assuming recursion is “free” space-wise.

**Fix:** Count maximum depth as space.

**Time:** usually same order · **Space:** recursion often costs the depth

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
