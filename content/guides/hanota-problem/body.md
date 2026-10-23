## Tiny example

Pegs **A** (start), **B** (helper), **C** (goal). Disks: small on large. Never larger on smaller.

**n = 2** (small + large on A):

```
start:  A=[large, small]  B=[]  C=[]
```

1. Move small A→B  
   `A=[large]  B=[small]  C=[]`
2. Move large A→C  
   `A=[]  B=[small]  C=[large]`
3. Move small B→C  
   `A=[]  B=[]  C=[large, small]`

Three moves = `2² − 1`.

**n = 3** uses the same idea twice around moving the largest:

1. Move 2-tower A→B (helper C) — 3 moves
2. Move largest A→C — 1 move
3. Move 2-tower B→C (helper A) — 3 moves  

Total **7** = `2³ − 1`.

## How

1. If n==1, move the disk directly
2. Else: move n−1 aside, move largest, move n−1 on top
3. Count: `T(n) = 2·T(n-1) + 1` → `2ⁿ − 1`

## Trap

Moving the largest while smaller disks still sit on it — illegal stack.

**Fix:** Always clear the n−1 tower first; the largest moves once per level.

**Moves:** Θ(2ⁿ)  
**Space:** O(n) recursion depth

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
