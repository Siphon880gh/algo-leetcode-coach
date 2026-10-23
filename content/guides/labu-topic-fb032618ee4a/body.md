## Tiny example

Houses in a line: `[2, 7, 9, 3, 1]`. You cannot rob two neighbors.

Walk left→right with “best ending here”:

```
house:  2   7   9   3   1
best:   2   7  11  11  12
```

- At 9: max(skip→7, take→2+9=11) → 11
- At 1: max(11, 11+1=12) → **12** (houses 2, 9, 1)

State sentence: `best[i]` = max money using houses `0…i`.

**After** that sentence, you recognize a **linear take/skip** pattern — not knapsack, not interval DP.

Other shapes (once state is clear):

| Feel of the state | Common shape |
|-------------------|--------------|
| Best along an index | 1D linear |
| Best for a prefix × capacity | knapsack-like |
| Best for substring `i…j` | interval |
| “Holding stock vs cash” | state machine |

## How

1. Say the state in words on a tiny example
2. Write the transition on that example
3. Only then map to a named pattern
4. Code the loops that match the dependencies

## Trap

Pasting a knapsack template onto every DP prompt.

**Fix:** State first; template second.

**Habit:** example → state sentence → pattern name

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
