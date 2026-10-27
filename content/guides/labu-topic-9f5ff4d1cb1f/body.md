## Tiny example

Two pointers from opposite ends, on the sorted array `[1, 2, 4, 7]` with target sum `6`:

1. Start with `L = 0` and `R = 3`. The sum is 1 + 7 = 8, which is too big, so move `R` left.
2. Now the sum is 1 + 4 = 5, which is too small, so move `L` right.
3. Now the sum is 2 + 4 = 6. Found it.

Pointers can also move in the same direction. A slow pointer and a fast pointer are used for filtering an array in place or for finding the middle of a list.

## How

1. Choose between opposite ends and the same direction.
2. Write down when `L` moves and when `R` moves.
3. Make sure every step makes progress in one direction.

## Trap

Moving both pointers without a rule that justifies each move.

**Fix:** Each move must keep the invariant "if an answer exists, it is still inside the range".

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
