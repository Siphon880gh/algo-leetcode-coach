## Tiny example

Build a max-heap from `[2, 3, 9, 5, 6]` **bottom-up**.

With n = 5, the last parent sits at index `(n-2)//2 = 1` (the value `3`).

Sift down from the last parent toward the root:

1. Index 1 (`3`): children `5,6` → sift → swap toward larger child as needed
2. Index 0 (`2`): sift down until heap order holds

Result shape has `9` at the root (exact array depends on ties/swaps) — **O(n)** total, not O(n log n).

## Contrast: n× push

Starting from empty and pushing n times is **O(n log n)**. Bottom-up heapify is tighter because lower subtrees are small.

## Trap

Implementing “build” as n inserts and still quoting O(n).

**Fix:** Use Floyd heapify (sift down from the last parent). Prove sum of heights → O(n).

**Time (heapify):** O(n)  
**Time (n pushes):** O(n log n)  
**Space:** O(1) extra in-array

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
