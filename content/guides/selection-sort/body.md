## Tiny example

Sort `[3, 1, 4, 2]`.

Pass 0 (build position 0):

1. Scan whole range → minimum is `1` at index 1
2. Swap with index 0 → `[1, 3, 4, 2]`

Pass 1 (position 1): min of rest is `2` → swap → `[1, 2, 4, 3]`

Continue until `[1, 2, 3, 4]`.

## How

1. For `i` in `0 … n-2`
2. Find index of minimum in `a[i … n-1]`
3. Swap with `a[i]`

## Trap

Confusing selection with insertion: selection **finds the min then swaps once**; insertion **slides** the next element left into a sorted prefix.

**Fix:** Name the invariant: after `i` passes, `a[0 … i-1]` holds the `i` smallest items (sorted).

**Time:** O(n²) always · **Space:** O(1)

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
