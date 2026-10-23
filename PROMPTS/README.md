# Loop prompts

Agent-facing **task menu** and Leet-number reporting live in [`AGENTS.md`](../AGENTS.md). Read that first, then the prompt for the task you picked.

Cursor `/loop` jobs that walk a queue one tick at a time. Author and mini-game prompts have matching `.track.json` files with `next`, `completed`, `skipped`, and `exhausted`. Read the prompt and tracker every tick. Update the tracker before the tick finishes.

Invoke from the repo root. Copy the **Invoke** block inside each prompt.

## Tasks (simplified)

| Task | Prompt | Notes |
|------|--------|--------|
| **Graph drain (default)** | [`graph-guides-and-links.md`](graph-guides-and-links.md) | Authors Algo Guides + Step-by-steps (keep `G`/`S` within 20) **and** pairs them each tick |
| **Mini games** | [`loop-mini-games.md`](loop-mini-games.md) | Creates games; links to Algo Guide and Step-by-step when they exist |

There is **no** standalone Guide ↔ session links task. Pairing is inlined in the graph. The old prompt is under [`archived/loop-guide-step-links.md`](archived/loop-guide-step-links.md). The pairing ledger file [`loop-guide-step-links.track.json`](loop-guide-step-links.track.json) remains for the graph only.

## Author children (used by the graph)

These walk `context/` (alphabetical repo order). Numbered LeetCode problems must set `'leetcode'` and `'difficulty'` from `context-leetcode-urls/data-difficulty.json`. When the other side or a matching mini game already exists, they set companion keys for that one pair only.

| Prompt | Writes |
|--------|--------|
| [`loop-step-by-step.md`](loop-step-by-step.md) | `content/coaching/{slug}/` |
| [`loop-algo-guides.md`](loop-algo-guides.md) | `content/guides/{slug}/` (`kind => 'algo'`) |
| [`loop-mini-games.md`](loop-mini-games.md) | `content/games/{slug}/` |

A loop is **drained** when its tracker has `"exhausted": true` (queue finished, `next` is `null`).

## Trackers

| Prompt | Tracker |
|--------|---------|
| Graph | Author trackers + pairing ledger below |
| `loop-step-by-step.md` | [`loop-step-by-step.track.json`](loop-step-by-step.track.json) |
| `loop-algo-guides.md` | [`loop-algo-guides.track.json`](loop-algo-guides.track.json) |
| `loop-mini-games.md` | [`loop-mini-games.track.json`](loop-mini-games.track.json) |
| Graph pairing ledger | [`loop-guide-step-links.track.json`](loop-guide-step-links.track.json) |

Author loops skip secondary LeetCode writeups with reason `leetcode_exists` when any page already has that problem number.
