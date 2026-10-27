## Tiny example

There is one item with weight **2** and value **3**. The bag holds **4**.

| Rule | What you may take | Best value |
|------|-------------------|------------|
| **0-1** | at most 1 copy | **3** (one item, with capacity 2 left unused) |
| **Complete (unbounded)** | any number of copies | **6** (two copies) |
| **Multiple** | at most **k** copies (say k = 1) | **3** (the same as 0-1 when k = 1) |

All three use the same `dp[c]` idea. What changes the loop is the **copy rule**:

| Flavor | Capacity loop in one array | Why |
|--------|----------------------------|-----|
| 0-1 | **backward**, from high to low | a small capacity updated in this pass cannot feed a larger one |
| Complete (unbounded) | **forward**, from low to high | a small capacity updated in this pass *should* feed more copies |
| Multiple (at most k) | split into k separate 0-1 items (or use a binary split), then loop backward | there is a hard cap on copies |

## How

1. Say the problem's copy rule out loud.
2. Choose the matching loop direction or expansion.
3. Only then write the code.

## Trap

Memorizing one knapsack loop and forcing it onto every problem.

**Fix:** Before writing `for c`, decide whether each item is used once, an unlimited number of times, or at most k times.

**Time:** typically O(nW), plus a log factor for the binary split

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
