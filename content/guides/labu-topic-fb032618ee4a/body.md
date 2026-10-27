## Tiny example

Houses stand in a line: `[2, 7, 9, 3, 1]`. You cannot rob two neighbors.

Walk from left to right, keeping the best total so far:

```
house:  2   7   9   3   1
best:   2   7  11  11  12
```

- At 9: the better of skipping it (7) and taking it (2 + 9 = 11) is 11.
- At 1: the better of 11 and 11 + 1 = 12 is **12**, from houses 2, 9 and 1.

The state sentence: `best[i]` is the most money you can get from houses `0` to `i`.

**Once** you can say that sentence, you recognize a **linear take-or-skip** pattern. It is not knapsack and not interval DP.

Other shapes, once the state is clear:

| What the state feels like | Common shape |
|---------------------------|--------------|
| Best value along an index | 1D linear |
| Best value for a prefix and a capacity | knapsack-like |
| Best value for a substring `i…j` | interval |
| "Holding a stock or holding cash" | state machine |

## How

1. Say the state in words, using a tiny example.
2. Write the transition on that example.
3. Only then match it to a named pattern.
4. Write the loops in the order the dependencies require.

## Trap

Pasting a knapsack template onto every DP problem.

**Fix:** Work out the state first, and choose a template second.

**Habit:** first an example, then a state sentence, then the pattern name

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
