## Two states

`cash = 0`, `hold = −prices[0]`. For each later price `p`:

- `cash = max(cash, hold + p − fee)`: sell today, or keep cash.
- `hold = max(hold, cash − p)`: buy today, or keep holding.

Updating `hold` with the new `cash` is safe: that is selling and buying back on the same day, which only loses the fee and is never better.

Return `cash`; ending with a share is never better than having sold it or never bought it.

Charge the fee once per transaction, either on the buy or on the sell; both give the same answer.

Do not greedily sum every price increase as in problem 122; the fee makes small moves unprofitable. Do not charge the fee on both sides.

Time: O(n)  
Space: O(1)

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
