## Tiny example

Heights `[1, 8, 6, 2, 5, 4, 8, 3, 7]` (classic).

```
L = 0 (height 1),  R = 8 (height 7)
width = 8
area = min(1,7) * 8 = 8
```

The short side is L (1). Moving R cannot help this pair — the min is stuck at 1. So move **L** right to the tall 8:

```
L = 1 (8), R = 8 (7)
area = min(8,7) * 7 = 49
```

Keep moving the shorter end until L meets R. Best area found: **49**.

Brute force checks every pair — O(n²). Two pointers — O(n).

## How

1. Place pointers at both ends
2. Record `min(h[L], h[R]) * (R-L)`
3. Move the shorter pointer inward (ties: either)
4. Stop when L >= R; return the max area seen

## Trap

Moving the taller pointer — width shrinks while the min cannot increase from that move’s partner.

**Fix:** Always advance the shorter side.

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
