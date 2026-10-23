## Tiny example

Two pointers summary.

Opposite ends on sorted `[1,2,4,7]`, target sum `6`:

1. `L=0,R=3` → 1+7=8 too big → `R--`
2. `1+4=5` too small → `L++`
3. `2+4=6` hit

Same-direction: slow/fast for in-place filters / mid of lists.


## How

1. Choose opposite-ends vs same-direction
2. Write when L moves vs R moves
3. Ensure monotonic progress


## Trap

Moving both pointers randomly without an invariant.

**Fix:** Each move should preserve “answer still possible in range”.

**Time:** O(n) · **Space:** O(1)

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
