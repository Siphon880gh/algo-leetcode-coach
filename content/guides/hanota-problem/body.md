## Tiny example

There are three pegs: **A** (start), **B** (helper) and **C** (goal). Disks sit small on top of large, and you may never put a larger disk on a smaller one.

**With n = 2** (a small and a large disk on A):

```
start:  A=[large, small]  B=[]  C=[]
```

1. Move the small disk from A to B.  
   `A=[large]  B=[small]  C=[]`
2. Move the large disk from A to C.  
   `A=[]  B=[small]  C=[large]`
3. Move the small disk from B to C.  
   `A=[]  B=[]  C=[large, small]`

That is three moves, which is `2² − 1`.

**With n = 3**, use the same idea around the largest disk:

1. Move the top two disks from A to B, using C as the helper. That takes 3 moves.
2. Move the largest disk from A to C. That takes 1 move.
3. Move the two disks from B to C, using A as the helper. That takes 3 moves.

The total is **7**, which is `2³ − 1`.

## How

1. If there is one disk, move it directly.
2. Otherwise, move the top n − 1 disks out of the way, move the largest disk, then move the n − 1 disks back on top of it.
3. The move count follows `T(n) = 2 × T(n − 1) + 1`, which gives `2ⁿ − 1`.

## Trap

Trying to move the largest disk while smaller disks are still on top of it. That move is not allowed.

**Fix:** Always clear the n − 1 smaller disks first. The largest disk moves exactly once at each level.

**Moves:** Θ(2ⁿ)  
**Space:** O(n) recursion depth

> [!ui-builder] Mini game
> INPUT_TOPIC: Theory or problem
> INPUT_SLUG: Folder slug (kebab-case)
> PROMPT:
> Use the harness skill at .agents/skills/harness to create a mini-game in this Leetcode Practice Coach IDE app that teaches [INPUT_TOPIC]. Place it under content/games/[INPUT_SLUG]/. Follow meta.php + index.html. Use .agents/skills/game-development-sickn33 for web/2d craft if needed.

> [!ui-builder] Step-by-step
> INPUT_TOPIC: Theory or problem
> INPUT_SLUG: Folder slug (kebab-case)
> PROMPT:
> Use the harness skill at .agents/skills/harness to create a step-by-step session for [INPUT_TOPIC] under content/coaching/[INPUT_SLUG]/. Include branching choices with clear labels, at least one wrong-path leaf with rewind_to, and a success leaf. Follow the tree.php contract so Step back and the Path visualizer work.
