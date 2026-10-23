## Tiny example

One item: weight **2**, value **3**. Bag capacity **4**.

| Rule | What you may take | Best value |
|------|-------------------|------------|
| **0-1** | at most 1 copy | **3** (one item, leftover capacity 2 unused) |
| **Complete / unbounded** | any number of copies | **6** (two copies) |
| **Multiple** | at most **k** copies (say k=1) | **3** (same as 0-1 for k=1) |

Same `dp[c]` idea — the **copy rule** changes the loop:

| Flavor | 1D capacity loop | Why |
|--------|------------------|-----|
| 0-1 | **backward** high→low | updated small c cannot feed a larger c this pass |
| Complete / unbounded | **forward** low→high | updated small c *should* feed more copies |
| Multiple (≤k) | expand into k 0-1 items (or binary split) then backward | hard cap on copies |

## How

1. Read the problem’s copy rule out loud
2. Pick the matching loop / expansion
3. Only then write code

## Trap

Memorizing one knapsack loop and forcing it onto every statement.

**Fix:** Say “once / unlimited / ≤k” before touching `for c`.

**Time:** typically O(nW) (plus log factors for binary split)

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
