## Tiny example

The heights are `[1, 8, 6, 2, 5, 4, 8, 3, 7]`. This is the classic example.

```
L = 0 (height 1),  R = 8 (height 7)
width = 8
area = min(1,7) * 8 = 8
```

The short side is L, with height 1. Moving R cannot help, because the smaller height stays stuck at 1. So move **L** right, to the tall line of height 8:

```
L = 1 (8), R = 8 (7)
area = min(8,7) * 7 = 49
```

Keep moving the shorter end until L meets R. The best area found is **49**.

Brute force checks every pair, which is O(n²). Two pointers take O(n).

## How

1. Place one pointer at each end.
2. Record `min(h[L], h[R]) * (R-L)`.
3. Move the shorter pointer inward. On a tie, move either one.
4. Stop when L >= R, and return the largest area seen.

## Trap

Moving the taller pointer. The width shrinks, and the smaller height cannot go up, because the shorter line is still part of the pair.

**Fix:** Always move the shorter side.

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
