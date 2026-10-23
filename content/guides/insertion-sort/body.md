## Tiny example

Sort `[3, 1, 4, 2]`.

Start with sorted prefix `[3]`.

1. Take `1` → slide left past `3` → `[1, 3, 4, 2]`
2. Take `4` → already ≥ `3` → stays → `[1, 3, 4, 2]`
3. Take `2` → slide left between `1` and `3` → `[1, 2, 3, 4]`

## How

1. For `i` from `1 … n-1`
2. Key = `a[i]`
3. While previous items are greater, shift them right
4. Drop key into the hole

## Trap

Expecting O(n log n) on reverse-sorted input.

**Fix:** Insertion is **O(n²)** worst/average; **O(n)** on already-sorted (each key stops immediately). Great for tiny or nearly sorted arrays; not a general large-n sort.

**Time:** O(n²) worst · **Space:** O(1)

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
