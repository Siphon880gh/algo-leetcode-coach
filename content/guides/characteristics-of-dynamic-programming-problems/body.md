## Tiny example

Coin change (unlimited coins) vs a path that forbids revisiting cities randomly:

- Coin change: best for capacity `c` depends on best for smaller capacities — **optimal substructure**
- Future decisions do not rewrite the meaning of a finished sub-answer — **no aftereffect** (Markov-like state)

If order of past choices still matters beyond what the state records, your state is incomplete (not “DP is impossible”).


## How

1. Name the state so it holds everything the future needs
2. Check subanswers compose optimally
3. Ensure transitions only read “smaller” states


## Trap

Forcing DP on a problem that needs the full path set without encoding path info in the state.

**Fix:** Enrich the state (or use another paradigm: search, greedy with proof, etc.).

**Checklist:** state, transition, base, order · **Time/Space:** problem-specific

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
